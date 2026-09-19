<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExhibitorUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store', 'updateStatus']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }

  public function exportToexcel(Request $request)
{
    $Company = $request->strCompany;
    $Status  = $request->StrStatus;

    // ✅ Clean values properly
    if ($Company === 'undefined' || $Company === '') {
        $Company = null;
    }

    if ($Status === 'undefined' || $Status === '' || $Status === 'null') {
        $Status = null;
    }

    // ✅ Query (same structure, just safe)
    $datas = ExhibitorUser::orderBy('iStatus', 'desc')
        ->when($Company != null, function ($query) use ($Company) {
            return $query->where('strCompany', 'LIKE', '%' . $Company . '%');
        })
        ->when($Status != null, function ($query) use ($Status) {
            return $query->where('iStatus', $Status);
        })
        ->get();

    // ✅ DEBUG (optional - remove later)
    // dd($datas->count());

    return view('users.excel', compact('datas'));
}

public function index(Request $request)
{
    try {
        $searchText = $request->searchText;

        $users = ExhibitorUser::where('isDelete', 0)
            ->when($searchText, function ($query, $searchText) {
                $query->where(function ($q) use ($searchText) {
                    $q->where('strCompany', 'LIKE', '%' . $searchText . '%')
                      ->orWhere('Mobile', 'LIKE', '%' . $searchText . '%');
                });
            })
            ->orderByDesc('iStatus')
            ->orderBy('strCompany', 'asc')
            ->paginate(10);

        return view('users.index', compact('users', 'searchText'));

    } catch (\Throwable $th) {
        DB::rollBack();

        return redirect()->back()
            ->withInput()
            ->with('error', $th->getMessage());
    }
}

    // public function index(Request $request)
    // {
    //     try {
    //         $Company = $request->strCompany;
    //         $users = ExhibitorUser::where(['isDelete' => 0])
    //             ->when($request->strCompany, fn ($query, $Company) => $query
    //                 ->where('exhibitoruser.strCompany', 'LIKE', '%' . $Company . '%'))
    //             ->paginate(10);

    //         return view('users.index', compact('users', 'Company'));
    //     } catch (\Throwable $th) {
    //         // Rollback and return with Error
    //         DB::rollBack();
    //         return redirect()->back()->withInput()->with('error', $th->getMessage());
    //     }
    // }

    public function create()
    {
        try {
            return view('users.add');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $pass = "Optic" . substr($request->Mobile, -4);
            $hash = Hash::make($pass);

            $user = ExhibitorUser::create([
                'strCompany'    => $request->strCompany,
                'strContactPerson'     => $request->strContactPerson,
                "strPassword" => $hash,
                'Mobile'     => $request->Mobile,
                'strEmail'     => $request->strEmail,
                'strCity'         => $request->strCity,
                'strStallNo' => $request->strStallNo,
                'strStallSize'       => $request->strStallSize,
                "strPlainPassword" => $pass,
                "strIP" => $request->ip(),
                "strEntryDate" => date('Y-m-d'),
            ]);

            $SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 8])
                ->first();

            $msg = array(
                'FromMail' => $SendEmailDetails->strFromMail,
                'Title' => $SendEmailDetails->strTitle,
                'ToEmail' => $request->strEmail,
                'Subject' => $SendEmailDetails->strSubject
            );

            $mail = Mail::send('emails.usersendlogindetail', ['user' => $user], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->cc('edit.margi@gmail.com')->subject($msg['Subject']);
            });

            return redirect()->route('users.index')->with('success', 'User Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'id'   => $user_id,
            'status'    => $status
        ], [
            'id'   =>  'required|exists:exhibitoruser,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if ($validate->fails()) {
            return redirect()->route('users.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            ExhibitorUser::where(['id'=>$user_id])->update(['iStatus' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $user = ExhibitorUser::where(['iStatus' => '1', 'isDelete' => 0, 'id' => $id])->first();

            return view('users.edit', compact('user'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $update = ExhibitorUser::whereId($id)->update([
                'strCompany'    => $request->strCompany,
                'Mobile'     => $request->Mobile,
                'strEmail'     => $request->strEmail,
                'strCity'         => $request->strCity,
                'strContactPerson'     => $request->strContactPerson,
                'strStallNo' => $request->strStallNo,
                'strStallSize'       => $request->strStallSize,
                "strIP" => $request->ip(),
                "updated_at" => date('Y-m-d'),
            ]);

            return redirect()->route('users.index')->with('success', 'User Updated Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function delete(Request $request, User $user,)
    {
        try {
            ExhibitorUser::whereId($request->id)->delete();

            return redirect()->route('users.index')->with('success', 'User Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Import Users
     * @param Null
     * @return View File
     */
    public function importUsers()
    {
        return view('users.import');
    }

    public function passwordupdate(Request $request)
    {
        try {
            $newpassword = ($request->newpassword);
            $confirmpassword = ($request->confirmpassword);

            if ($newpassword == $confirmpassword) {
                $Password = DB::table('exhibitoruser')
                    ->where(['id' => $request->id])
                    ->update([
                        'strPassword' => Hash::make($request->confirmpassword),
                        'strPlainPassword' => $request->confirmpassword,
                    ]);
                return redirect()->route('users.index')->with('success', 'User Password Updated Successfully.');
            } else {
                return redirect()->route('users.index')->with('error', 'password and confirm password does not match');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function sendmail(Request $request, $id)
    {
        try {
            $data = ExhibitorUser::orderBy('id', 'DESC')
                ->where(['isDelete' => 0, 'id' => $id])
                ->first();

            $SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 8])
                ->first();

            $msg = array(
                'FromMail' => $SendEmailDetails->strFromMail,
                'Title' => $SendEmailDetails->strTitle,
                'ToEmail' => $data->strEmail,
                'Subject' => $SendEmailDetails->strSubject
            );

            $mail = Mail::send('emails.passwordemail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->cc('edit.margi@gmail.com')->subject($msg['Subject']);
            });

            return back()->with('success', 'Send Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function mobilecheck(Request $request)
    {
        try {
            $mobile = ExhibitorUser::where(['isDelete' => 0, 'Mobile' => $request->mobile])->count();
            if ($mobile > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function editmobilecheck(Request $request)
    {
        try {
            $mobile = ExhibitorUser::where(['isDelete' => 0, 'Mobile' => $request->mobile])->count();
            if ($mobile > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
