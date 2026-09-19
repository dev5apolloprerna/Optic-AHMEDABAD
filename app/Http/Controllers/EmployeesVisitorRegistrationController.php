<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class EmployeesVisitorRegistrationController extends Controller
{
    public function index(Request $request)
    {

        $Data = Visitor::orderBy('visiterId', 'DESC')
            ->where(['isDelete' => 0, 'employee_enter_by' => Auth::user()->id])
            ->paginate(25);

        return view('employees.visitorregistration.index', compact('Data'));
    }

    public function create()
    {
        $states = State::orderBy('stateName', 'asc')->get();

        return view('employees.visitorregistration.add', compact('states'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'name' => 'required|string|max:100',
    //             'email' => 'required|email|max:150',
    //             'companyName' => 'required|string|max:150',
    //             'mobile' => 'required|digits:10|unique:visiter,mobile',
    //             'state' => ['required'],
    //             'city' => ['required_unless:state,Other'],
    //             'otherstate' => ['required_if:state,Other'],
    //             'othercity' => ['required_if:state,Other'],
    //             'visitDate' => 'required|min:1',  // At least one date selected
    //             'interested' => 'required|string'
    //         ],
    //         [
    //             'mobile.digits' => 'Mobile number must be exactly 10 digits.',
    //             'mobile.unique' => 'This mobile number is already registered.',
    //             'city.required_unless' => 'Please select a city.',
    //             'otherstate.required_if' => 'Please enter a custom state.',
    //             'othercity.required_if' => 'Please enter a custom city.',
    //             'visitDate.required' => 'Please select at least one visit date.'
    //         ]
    //     );

    //     // $State = ($request->state == "Other") ? $request->otherstate : $request->state;
    //     if ($request->state == "Other") {
    //         $State = $request->otherstate;
    //     } else {
    //         $stateData = DB::table('state')->where('stateId', $request->state)->first();
    //         $State = $stateData ? $stateData->stateName : null;
    //     }
    //     $City = ($request->city == "Other" || empty($request->city)) ? $request->othercity : $request->city;

    //     $ip = $request->ip();
    //     $data = array(
    //         'name' => ucwords($request->name),
    //         'companyName' => ucwords($request->companyName),
    //         'email' => strtolower($request->email),
    //         'mobile' => $request->mobile,
    //         'state' => ucwords($State),
    //         'city' => ucwords($City),
    //         'visitDate' => $request->visitDate,
    //         'interested' => $request->interested,
    //         'strEntryDate' => date('Y-m-d'),
    //         'employee_enter_by' => Auth::user()->id,
    //         "strIP" => $ip
    //     );
    //     $GetId = DB::table('visiter')->insertGetId($data);

    //     DB::table('visiter')
    //         ->where(['isDelete' => 0, 'visiterId' => $GetId])
    //         ->update([
    //             'earthconId' => 'OPTIC-' . $GetId,
    //             'visitRefId' => $GetId,
    //         ]);

    //     $SendEmailDetails = DB::table('sendemaildetails')
    //         ->where(['id' => 4])
    //         ->first();

    //     $msg = array(
    //         'FromMail' => $SendEmailDetails->strFromMail,
    //         'Title' => $SendEmailDetails->strTitle,
    //         'ToEmail' => $request->email,
    //         'Subject' => $SendEmailDetails->strSubject
    //     );

    //     Mail::send('emails.front_visitor_registration', ['data' => $data, 'GetId' => $GetId], function ($message) use ($msg) {
    //         $message->from($msg['FromMail'], $msg['Title'])
    //             ->to($msg['ToEmail'])
    //             ->cc('edit.margi@gmail.com')
    //             ->subject($msg['Subject']);
    //     });

    //     return redirect()->route('employees_module.thank_you')->with(['data' => $data]);
    // }
    
    // public function  thank_you()
    // {
    //     try {
    //         $data = session('data');
    //         if ($data) {
    //             return view('employees.visitorregistration.thank_you', compact('data'));
    //         } else {
    //             return redirect()->route('employees_module.index');
    //         }
    //     } catch (\Throwable $th) {
    //         // Rollback and return with Error
    //         DB::rollBack();
    //         return redirect()->back()->withInput()->with('error', $th->getMessage());
    //     }
    // }
    
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:150',
                'companyName' => 'required|string|max:150',
                'mobile' => 'required|digits:10|unique:visiter,mobile',
                'state' => ['required'],
                'city' => ['required_unless:state,Other'],
                'otherstate' => ['required_if:state,Other'],
                'othercity' => ['required_if:state,Other'],
                'visitDate' => 'required|min:1',  // At least one date selected
                'interested' => 'required|string'
            ],
            [
                'mobile.digits' => 'Mobile number must be exactly 10 digits.',
                'mobile.unique' => 'This mobile number is already registered.',
                'city.required_unless' => 'Please select a city.',
                'otherstate.required_if' => 'Please enter a custom state.',
                'othercity.required_if' => 'Please enter a custom city.',
                'visitDate.required' => 'Please select at least one visit date.'
            ]
        );

        // $State = ($request->state == "Other") ? $request->otherstate : $request->state;
        if ($request->state == "Other") {
            $State = $request->otherstate;
        } else {
            $stateData = DB::table('state')->where('stateId', $request->state)->first();
            $State = $stateData ? $stateData->stateName : null;
        }
        $City = ($request->city == "Other" || empty($request->city)) ? $request->othercity : $request->city;

        $ip = $request->ip();
        $data = array(
            'name' => ucwords($request->name),
            'companyName' => ucwords($request->companyName),
            'email' => strtolower($request->email),
            'mobile' => $request->mobile,
            'state' => ucwords($State),
            'city' => ucwords($City),
            'visitDate' => $request->visitDate,
            'interested' => $request->interested,
            'strEntryDate' => date('Y-m-d'),
            'employee_enter_by' => Auth::user()->id,
            "strIP" => $ip
        );
        $GetId = DB::table('visiter')->insertGetId($data);


            $qrText =
                $data['companyName'] . '~' .
                $data['name'] . '~' .
                $data['mobile'] . '~' .
                $data['city'] . '~' .
                date('d-m-Y', strtotime($data['strEntryDate'])) . '~' .
                date('d-m-Y', strtotime($data['visitDate']));
        
            // Create QR Folder
            $qrDirectory = $_SERVER['DOCUMENT_ROOT'] . '/Ahmedabad/qrcodes';
        
               if (!file_exists($qrDirectory)) {
            mkdir($qrDirectory, 0755, true);
        }
        
        $qrFile = 'visitor_' . $GetId . '.png';
        $qrPath = $qrDirectory . '/' . $qrFile;
        
        QrCode::format('png')
            ->size(250)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($qrText, $qrPath);
            
            
        
        DB::table('visiter')
            ->where(['isDelete' => 0, 'visiterId' => $GetId])
            ->update([
                'earthconId' => 'OPTIC-' . $GetId,
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

        Mail::send('emails.front_visitor_registration', 
        [
                    'data' => $data,
                    'GetId' => $GetId,
                    'qrFile' => $qrFile
        ],
        
        function ($message) use ($msg) {
            $message->from($msg['FromMail'], $msg['Title'])
                ->to($msg['ToEmail'])
                ->cc('edit.margi@gmail.com')
                ->subject($msg['Subject']);
        });
        
        return redirect()->route('employees_module.thank_you')->with(['data' => $data,'qrFile' => $qrFile]);
        // return redirect()->route('employees_module.thank_you')->with(['data' => $data]);
    }
    
    public function  thank_you()
    {
        try {
            $data = session('data');
            $qrFile = session('qrFile');
            if ($data) {
                return view('employees.visitorregistration.thank_you', compact('data','qrFile'));
            } else {
                return redirect()->route('employees_module.index');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function delete(Request $request)
    {
        DB::table('visiter')->where(['isDelete' => 0, 'visiterId' => $request->id])->delete();

        return back()->with('success', 'Visitor Registration Deleted Successfully!.');
    }

}
