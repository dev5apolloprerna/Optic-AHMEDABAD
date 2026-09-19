<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;
use Illuminate\Support\Facades\Mail;


class UserVisitorRegistrationController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {

                $session = Session::get('ExhibitorUserId');
                $states = State::orderBy('stateName', 'asc')->get();
                $Data = Visitor::orderBy('visiterId', 'desc')->where(['isDelete' => 0, 'Entry_by' => $session])->paginate(25);

                return view('ExhibitorUserFiles.visitorregistration.index', compact('Data', 'states'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function create(Request $request)
    {
        // try {
            $session = Session::get('ExhibitorUserId');
            request()->validate(
                [
                    'mobile' => 'required|unique:visiter',
                ]
            );
            
            // Get State Name
            if ($request->state == "Other") {
                $State = $request->otherstate;
            } else {
                $stateData = DB::table('state')
                    ->where('stateId', $request->state)
                    ->first();
            
                $State = $stateData ? $stateData->stateName : null;
            }
            
            // Get City Name
            $City = ($request->city == "Other" || empty($request->city))
                ? $request->othercity
                : $request->city;

            $data = array(
                'Entry_by' => $session,
                'name' => ucwords($request->name),
                'companyName' => ucwords($request->companyName),
                'email' => strtolower($request->email),
                'mobile' => $request->mobile,
                'state' => ucwords($State),
                'city' => ucwords($City),
                'visitDate' => $request->visitDate,
                'interested' => $request->interested,
                'strEntryDate' => date('Y-m-d'),
                "strIP" => $request->ip()
            );
            $GetId = DB::table('visiter')->insertGetId($data);

            $update = DB::table('visiter')
                ->where(['isDelete' => 0, 'visiterId' => $GetId])
                ->update([
                    'earthconId' => 'Furniture-' . $GetId,
                    // 'earthconId' => 'EARTHCON24_' . $GetId,
                    'visitRefId' => $GetId,
                ]);

            $SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 4])
                ->first();

            $msg = array(
                'FromMail' => $SendEmailDetails->strFromMail,
                'Title' => $SendEmailDetails->strTitle,
                'ToEmail' => $request->email,
                'Subject' => $SendEmailDetails->strSubject
            );
            // dd($msg);

            $mail = Mail::send('emails.front_visitor_registration', ['data' => $data, 'GetId' => $GetId], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->cc('edit.margi@gmail.com')->subject($msg['Subject']);
            });

            return back()->with('success', 'Registration Successfully.');
        // } catch (\Throwable $th) {
        //     // Rollback and return with Error
        //     DB::rollBack();
        //     return redirect()->back()->withInput()->with('error', $th->getMessage());
        // }
    }

    public function checkmobile(Request $request)
    {
        try {
            $mobile = Visitor::where(['isDelete' => 0, 'mobile' => $request->mobile])->count();
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
