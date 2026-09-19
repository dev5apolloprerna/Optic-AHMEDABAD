<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeesMasterController extends Controller
{
    
    
    public function index(Request $request)
        {
            try {
                $users = DB::table('users as u')
                    ->leftJoin('visiter as v', 'u.id', '=', 'v.employee_enter_by')
                    ->select(
                        'u.*',
                        DB::raw('COUNT(v.visiterId) as total_count'),
                        DB::raw("
                            SUM(
                                CASE
                                    WHEN DATE(v.strEntryDate) = CURDATE()
                                    THEN 1 ELSE 0
                                END
                            ) as today_count
                        ")
                    )
                    ->where('u.role_id', '3')
                    ->groupBy('u.id')
                    ->orderBy('u.id', 'desc')
                    ->get();
        
                return view('employees.index', compact('users'));
        
            } catch (\Exception $e) {
                report($e);
                return false;
            }
        }
        
    // public function index(Request $request)
    // {
    //     try {
    //         $users = User::orderBy('id', 'desc')->where('role_id','3')->paginate(env('PER_PAGE_COUNT'));

    //         return view('employees.index', compact('users'));
    //     } catch (\Exception $e) {
    //         report($e);
    //         return false;
    //     }
    // }

    public function store(Request $request)
    {
        try {
            
            $Data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 3,
                'status' => 1,
                'created_at' => now()
            );
            // dd($Data);
            DB::table('users')->insert($Data);

            return back()->with('success', 'Employees Created Successfully.');
            
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    public function editview(Request $request, $id)
    {
        try {
            $data = User::where(['id' => $id])->first();

            echo json_encode($data);
        } catch (\Exception $e) {

            report($e);

            return false;
        }
    }

    public function update(Request $request)
    {
        try {

            $update = DB::table('users')
                ->where(['id' => $request->id])
                ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'updated_at' => now()
                ]);

            return back()->with('success', 'Employees Updated Successfully.');
        } catch (\Exception $e) {

            report($e);

            return false;
        }
    }



    public function delete(Request $request)
    {
        try {
           
            DB::table('users')->where(['id' => $request->id])->delete();

            return back()->with('success', 'Employees Deleted Successfully!.');
        } catch (\Exception $e) {

            report($e);

            return false;
        }
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|min:6|confirmed',
        ]);
    
        try {
    
            DB::table('users')
                ->where('id', $request->user_id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);
    
            return redirect()
                ->route('employees.index')
                ->with('success', 'Password changed successfully.');
    
        } catch (\Exception $e) {
    
            report($e);
    
            return redirect()
                ->route('employees.index')
                ->with('error', 'Something went wrong while changing password.');
        }
    }
   
}
