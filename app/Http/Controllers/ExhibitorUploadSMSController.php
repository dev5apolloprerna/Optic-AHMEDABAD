<?php

namespace App\Http\Controllers;

use App\Models\SMSData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ExhibitorUploadSMSController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $Data = SMSData::orderBy('SMSId', 'desc')->where(['iStatus' => 1, 'isDelete' => 0, 'iUserId' => $session])->paginate(25);

                return view('ExhibitorUserFiles.smsdata.index', compact('Data'));
            } else {
                return redirect()->route('exhibitorlogin')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function create(Request $request)
    {
        // $request->validate(
        //     [
        //         'strFileName' => 'required|mimes:xlsx,xls',
        //         'strPhoto' => 'nullable|mimes:jpeg,jpg,png,webp'
        //     ]
        // );
        try {
            $session = Session::get('ExhibitorUserId');
            $img = "";
            if ($request->hasFile('strFileName')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('strFileName');
                $img = time() . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/Upload/';
                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $image->move($destinationpath, $img);
            }
            $imgstore = "";
            if ($request->hasFile('strPhoto')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $pdf = $request->file('strPhoto');
                $imgstore = time() . '.' . $pdf->getClientOriginalExtension();
                $pdfdestinationpath = $root . '/WhatsappPhoto/';
                if (!file_exists($pdfdestinationpath)) {
                    mkdir($pdfdestinationpath, 0755, true);
                }
                $pdf->move($pdfdestinationpath, $imgstore);
            }

            $Data = array([
                'strMessage'    => $request->strMessage,
                'strFileName' => $img,
                'strPhoto' => $imgstore ?? null,
                'iUserId' => $session,
                'strEntryDate' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip()
            ]);
            //dd($Data);

            DB::table('smsdata')->insert($Data);

            return back()->with('success', 'SMS Data Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
