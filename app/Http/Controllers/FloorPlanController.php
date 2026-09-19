<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FloorPlan;
use Illuminate\Support\Facades\DB;

class FloorPlanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $FromDate = $request->fromdate;
            $ToDate = $request->todate;

            $FloorPlan = FloorPlan::orderBy('id', 'DESC')
                ->where(['isDelete' => 0])
                ->when($request->fromdate, fn ($query, $FromDate) => $query
                    ->where('floor_plan.strEntryDate', '>=', date('Y-m-d', strtotime($FromDate))))
                ->when($request->todate, fn ($query, $ToDate) => $query
                    ->where('floor_plan.strEntryDate', '<=', date('Y-m-d', strtotime($ToDate))))
                ->paginate(25);

            return view('floor_plan.index', compact('FloorPlan', 'FromDate', 'ToDate'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            FloorPlan::where(['isDelete' => 0, 'id' => $request->id])->delete();

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
                $Data = FloorPlan::where('id', '=', $id)->delete($data);
            }
            echo $Data;
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
