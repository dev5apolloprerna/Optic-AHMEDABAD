<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Brochure;
use App\Models\Visitor;
use App\Models\SponsoredRegistration;
use App\Models\BecomeAnExhibitor;
use App\Models\BookMyStall;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        // try {
        $Brochure = BookMyStall::where(["isDelete" => 0])->count();
        $Visiter = Visitor::where(["isDelete" => 0])->count();
        
        $InternationalVisitor = Visitor::where('isDelete', 0)
            ->whereNotIn('country', ['India', ''])
            ->whereNotNull('country')
            ->count();
        $VisiterDate = Visitor::orderBY('visitDate', 'asc')
            ->select("visitDate", DB::raw("count(*) as count"))
            ->groupBy('visitDate')
            ->get();
        
            
        $FloorPlan = DB::table('floor_plan')->where(["isDelete" => 0])->count();
        
        $empregistration = DB::table('visiter')->where(["employee_enter_by" => Auth::user()->id ])->count();
        $emp_today_registration = DB::table('visiter')->where(["employee_enter_by" => Auth::user()->id , 'strEntryDate' => date('Y-m-d') ])->count();    

        return view('home', compact('Brochure', 'Visiter','InternationalVisitor', 'VisiterDate','empregistration','emp_today_registration','FloorPlan'));
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return back()->with('error', $th->getMessage());
        // }
    }

    /**
     * User Profile
     * @param Nill
     * @return View Profile
     * @author Shani Singh
     */
    public function getProfile()
    {
        return view('profile');
    }


    public function EditProfile()
    {
        return view('Editprofile');
    }

    /**
     * Update Profile
     * @param $profileData
     * @return Boolean With Success Message
     * @author Shani Singh
     */
    public function updateProfile(Request $request)
    {
        try {
            DB::beginTransaction();

            #Update Profile Data
            User::whereId(auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
            ]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Profile Updated Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Change Password
     * @param Old Password, New Password, Confirm New Password
     * @return Boolean With Success Message
     * @author Shani Singh
     */
    public function changePassword(Request $request)
    {
        try {
            $session = Auth::user()->id;

            $user = User::where('id', '=', $session)->where(['status' => 1])->first();

            if (Hash::check($request->current_password, $user->password)) {
                $newpassword = $request->new_password;
                $confirmpassword = $request->new_confirm_password;

                if ($newpassword == $confirmpassword) {
                    $Student = DB::table('users')
                        ->where(['status' => 1, 'id' => $session])
                        ->update([
                            'password' => Hash::make($confirmpassword),
                        ]);
                    return redirect()->route('logout');
                } else {
                    return back()->with('error', 'password and confirm password does not match');
                }
            } else {
                return back()->with('error', 'Current Password does not match');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
