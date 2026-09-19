<?php

namespace App\Http\Controllers;

use App\Models\ExhibitorUser;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;


class ExhibitorLoginController extends Controller
{

    public function exhibitorloginsubmit(Request $request)
    {
        try {
            $mobile = $request->Mobile;
            $password = $request->strPassword;
            if ($mobile == '' && $password == '') {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Please Enter Mobile and password');
            } else {
                $ExhibitorUser = ExhibitorUser::where('Mobile', trim($request->Mobile))->where(['isDelete' => 0,])->first();
                if (!$ExhibitorUser || !Hash::check($request->strPassword, $ExhibitorUser->strPassword)) {
                    return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
                } else {
                    $request->session()->put('ExhibitorUserId', $ExhibitorUser->id);
                    $request->session()->put('strCompany', $ExhibitorUser->strCompany);
                    $request->session()->put('Mobile', $ExhibitorUser->Mobile);
                    $request->session()->put('strEmail', $ExhibitorUser->strEmail);
                    $request->session()->put('strContactPerson', $ExhibitorUser->strContactPerson);
                    $request->session()->put('strEntryDate', $ExhibitorUser->strEntryDate);

                    return redirect()->route('exhibitordashboard');
                }
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitordashboard(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                return view('ExhibitorUserFiles.ExhibitorDashboard');
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function ProfileDetail(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $ExhibitorUser = ExhibitorUser::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $session])->first();
                return view('ExhibitorUserFiles.ExhibitorProfile', compact('ExhibitorUser'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function EditProfile(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $ExhibitorUser = ExhibitorUser::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $session])->first();
                return view('ExhibitorUserFiles.ExhibitorEditprofile', compact('ExhibitorUser'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $session = Session::get('ExhibitorUserId');
            $request->session()->forget('strContactPerson');
            $request->session()->forget('Mobile');
            $request->session()->forget('strEmail');

            $data = DB::table('exhibitoruser')
                ->where(['iStatus' => 1, 'isDelete' => 0, 'id' => $session])
                ->update([
                    'strContactPerson' => $request->strContactPerson,
                    'Mobile' => $request->Mobile,
                    'strEmail' => $request->strEmail
                ]);
            $request->session()->put('Mobile', $request->Mobile);
            $request->session()->put('strEmail', $request->strEmail);
            $request->session()->put('strContactPerson', $request->strContactPerson);

            return back()->with('success', 'Profile Updated Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $ExhibitorUser = ExhibitorUser::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $session])->first();

                if (Hash::check($request->current_password, $ExhibitorUser->strPassword)) {
                    $newpassword = $request->new_password;
                    $confirmpassword = $request->new_confirm_password;

                    if ($newpassword == $confirmpassword) {
                        $data = DB::table('exhibitoruser')
                            ->where(['iStatus' => 1, 'isDelete' => 0, 'id' => $session])
                            ->update([
                                'strPassword' => Hash::make($confirmpassword),
                                'strPlainPassword' => $request->new_confirm_password
                            ]);
                        return back()->with('success', 'Password Updated Successfully.');
                    } else {
                        return back()->with('error', 'Password And Confirm Password Does Not Match');
                    }
                } else {
                    return back()->with('error', 'Current Password does not match');
                }
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function StallDesignCancel(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                return view('ExhibitorUserFiles.stalldesigncancel');
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function StallDesignAccept(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                return view('ExhibitorUserFiles.stalldesignaccept');
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function StallDesignFormPDF()
    {
        try {
            $pdf = PDF::loadView('ExhibitorUserFiles.StallDesignFormPDF');

            return $pdf->stream('VENDOR_REGISTRAION_FORM.pdf');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorlogout(Request $request)
    {
        try {
            $request->session()->forget('ExhibitorUserId');
            $request->session()->forget('strCompany');
            $request->session()->forget('Mobile');
            $request->session()->forget('strEmail');
            $request->session()->forget('strContactPerson');
            $request->session()->forget('strEntryDate');
            return redirect()->route('FrontExhibitor_Login');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
