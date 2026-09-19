<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMSData;
use Illuminate\Support\Facades\DB;

class SMSDataController extends Controller
{
    public function index(Request $request)
    {
        try {
            $SMSData = SMSData::orderBy('SMSId', 'DESC')
                ->where(['smsdata.iStatus' => 1, 'smsdata.isDelete' => 0])
                ->join("exhibitoruser", "smsdata.iUserId", '=', "exhibitoruser.id")
                ->paginate(25);

            return view('SMSData.index', compact('SMSData'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $delete = DB::table('smsdata')->where(['iStatus' => 1, 'isDelete' => 0, 'SMSId' => $id])->first();

            $root = $_SERVER['DOCUMENT_ROOT'];
            $excelpath = $root . '/Upload/';
            $photopath = $root . '/WhatsappPhoto/';

            if (file_exists($excelpath . $delete->strFileName)) {
                unlink($excelpath  . $delete->strFileName);
            }

            if (file_exists($photopath . $delete->strPhoto)) {
                unlink($photopath  . $delete->strPhoto);
            }

            DB::table('smsdata')->where(['iStatus' => 1, 'isDelete' => 0, 'SMSId' => $id])->delete();

            return back()->with('success', 'SMSData Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
