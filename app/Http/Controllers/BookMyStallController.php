<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookMyStall;
use Illuminate\Support\Facades\DB;

class BookMyStallController extends Controller
{
    public function index(Request $request)
    {
        try {
            $FromDate = $request->fromdate;
            $ToDate = $request->todate;

            $Brochure = BookMyStall::orderBy('brochureId', 'DESC')
                ->where(['isDelete' => 0])
                ->when($request->fromdate, fn ($query, $FromDate) => $query
                    ->where('book_my_stall.strEntryDate', '>=', date('Y-m-d', strtotime($FromDate))))
                ->when($request->todate, fn ($query, $ToDate) => $query
                    ->where('book_my_stall.strEntryDate', '<=', date('Y-m-d', strtotime($ToDate))))
                ->paginate(25);

            return view('book_my_stall.index', compact('Brochure', 'FromDate', 'ToDate'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            BookMyStall::where(['isDelete' => 0, 'brochureId' => $request->brochureId])->delete();

            return back()->with('success', 'Book My Stall Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function deleteselected(Request $request)
    {
        try {
            $Data = 0;
            $data = array('iStatus' => 1, 'isDelete' => 0);
            foreach ($request->check_list as $id) {
                $Data = BookMyStall::where('brochureId', '=', $id)->delete($data);
            }
            echo $Data;
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
