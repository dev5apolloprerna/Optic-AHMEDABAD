<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        try {
            $EntryDate = $request->strEntryDate;
            $Mobile = $request->mobile;
            
            $Visiter = Visitor::with('user')
                ->where('isDelete', 0)
                ->when($request->strEntryDate, fn ($query, $EntryDate) =>
                    $query->where('visitDate', '=', $EntryDate)
                )
                ->when($request->mobile, fn ($query, $Mobile) =>
                    $query->where('mobile', 'LIKE', '%' . $Mobile . '%')
                )
                ->orderBy('visiterId', 'DESC')
                ->paginate(25);

            // $Visiter = Visitor::orderBy('visiterId', 'DESC')
            //     ->where(['isDelete' => 0])
            //     ->when($request->strEntryDate, fn ($query, $EntryDate) => $query
            //         ->where('visiter.visitDate', '=', $EntryDate))
            //     ->when($request->mobile, fn ($query, $Mobile) => $query
            //         ->where('visiter.mobile', 'LIKE', '%' . $Mobile . '%'))
            //     ->paginate(25);

            return view('visitor.index', compact('Visiter', 'EntryDate', 'Mobile'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    
    public function sendmail(Request $request, $id)
    {
        $data = Visitor::orderBy('visiterId', 'DESC')
            ->where(['isDelete' => 0, 'visiterId' => $id])
            ->first();
    
        // QR FILE NAME
        $qrFile = 'visitor_' . $id . '.png';
    
        // QR PATH
        $qrDirectory = $_SERVER['DOCUMENT_ROOT'] . '/Ahmedabad/qrcodes';
        $qrPath = $qrDirectory . '/' . $qrFile;
    
        // CREATE QR FOLDER IF NOT EXIST
        if (!file_exists($qrDirectory)) {
            mkdir($qrDirectory, 0755, true);
        }
    
        // IF QR NOT EXIST → GENERATE NEW
        if (!file_exists($qrPath)) {
    
            $qrText =
                $data->companyName . '~' .
                $data->name . '~' .
                $data->mobile . '~' .
                $data->city . '~' .
                date('d-m-Y', strtotime($data->strEntryDate)) . '~' .
                date('d-m-Y', strtotime($data->visitDate));
    
            QrCode::format('png')
                ->size(250)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($qrText, $qrPath);
        }
    
        // QR URL FOR EMAIL
        $qrUrl = url('qrcodes/' . $qrFile);
    
        $SendEmailDetails = DB::table('sendemaildetails')
            ->where(['id' => 4])
            ->first();
    
        $msg = [
            'FromMail' => $SendEmailDetails->strFromMail,
            'Title'    => $SendEmailDetails->strTitle,
            'ToEmail'  => $data->email,
            'Subject'  => $SendEmailDetails->strSubject
        ];
    
        Mail::send(
            'emails.front_visitor_registration',
            [
                'data' => $data,
                'GetId' => $id,
                'qrFile' => $qrFile,
                'qrUrl' => $qrUrl
            ],
            function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])
                    ->cc('edit.margi@gmail.com')
                    ->subject($msg['Subject']);
            }
        );
    
        return back()->with('success', 'Send Successfully.');
    }

    // public function sendmail(Request $request, $id)
    // {
    //     try {
    //         $data = Visitor::orderBy('visiterId', 'DESC')
    //             ->where(['isDelete' => 0, 'visiterId' => $id])
    //             ->first();

    //         $SendEmailDetails = DB::table('sendemaildetails')
    //             ->where(['id' => 4])
    //             ->first();

    //         $msg = array(
    //             'FromMail' => $SendEmailDetails->strFromMail,
    //             'Title' => $SendEmailDetails->strTitle,
    //             'ToEmail' => $data->email,
    //             'Subject' => $SendEmailDetails->strSubject
    //         );

    //         $mail = Mail::send('emails.visitormailsend', ['data' => $data], function ($message) use ($msg) {
    //             $message->from($msg['FromMail'], $msg['Title']);
    //             $message->to($msg['ToEmail'])->cc('edit.margi@gmail.com')->subject($msg['Subject']);
    //         });

    //         return back()->with('success', 'Send Successfully.');
    //     } catch (\Throwable $th) {
    //         // Rollback and return with Error
    //         DB::rollBack();
    //         return redirect()->back()->withInput()->with('error', $th->getMessage());
    //     }
    // }
    
    public function preview($id)
    {
        $data = Visitor::where([
            'isDelete' => 0,
            'visiterId' => $id
        ])->first();
    
        $GetId = $id; // ADD THIS
    
        $qrFile = 'visitor_' . $id . '.png';
    
        $qrDirectory = $_SERVER['DOCUMENT_ROOT'] . '/Ahmedabad/qrcodes';
        $qrPath = $qrDirectory . '/' . $qrFile;
    
        if (!file_exists($qrDirectory)) {
            mkdir($qrDirectory, 0755, true);
        }
    
        if (!file_exists($qrPath)) {
    
            $qrText =
                $data->companyName . '~' .
                $data->name . '~' .
                $data->mobile . '~' .
                $data->city . '~' .
                date('d-m-Y', strtotime($data->strEntryDate)) . '~' .
                date('d-m-Y', strtotime($data->visitDate));
    
            QrCode::format('png')
                ->size(250)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($qrText, $qrPath);
        }
    
        $qrUrl = url('qrcodes/' . $qrFile);
    
        return view('visitor.preview', compact('data','qrUrl','qrFile','GetId'));
    }
    
    public function internationalvisitor(Request $request)
    {
        $EntryDate = $request->strEntryDate;
        $Mobile = $request->mobile;
    
        $Visiter = Visitor::orderBy('visiterId', 'DESC')
            ->where('isDelete', 0)
    
           // Show all international visitors
            ->whereNotNull('country')
            ->whereNotIn('country', ['India', ''])
    
            // ✅ Filter by date if provided
            ->when($request->strEntryDate, function ($query, $EntryDate) {
                $query->where('visitDate', $EntryDate);
            })
    
            // ✅ Filter by mobile if provided
            ->when($request->mobile, function ($query, $Mobile) {
                $query->where('mobile', 'LIKE', '%' . $Mobile . '%');
            })
    
            ->paginate(25);
    
        return view('visitor.international', compact('Visiter', 'EntryDate', 'Mobile'));
    }
    
    public function internationalvisitorExcel(Request $request, $Mobile = null, $EntryDate = null)
    {
        $Visiter = Visitor::orderBy('visiterId', 'DESC')
            ->where('isDelete', 0)
    
           // Show all international visitors
            ->whereNotNull('country')
            ->whereNotIn('country', ['India', ''])
    
            // ✅ Filter by date
            ->when($EntryDate, function ($query, $EntryDate) {
                $query->where('visitDate', $EntryDate);
            })
    
            // ✅ Filter by mobile
            ->when($Mobile, function ($query, $Mobile) {
                $query->where('mobile', 'LIKE', '%' . $Mobile . '%');
            })
    
            ->get();
    
        return view('visitor.internationalexcel', compact('Visiter', 'Mobile', 'EntryDate'));
    }

    public function delete(Request $request)
    {
        try {
            DB::table('visiter')->where(['isDelete' => 0, 'visiterId' => $request->visiterId])->delete();

            return back()->with('success', 'Visitor Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function visitorExcel(Request $request, $Mobile = null, $EntryDate = null)
    {
        try {
            $Visiter = Visitor::orderBy('visiterId', 'DESC')
                ->where(['isDelete' => 0])
                ->when($EntryDate, fn ($query, $EntryDate) => $query
                    ->where('visiter.visitDate', '=', $EntryDate))
                ->when($Mobile, fn ($query, $Mobile) => $query
                    ->where('visiter.mobile', 'LIKE', '%' . $Mobile . '%'))
                ->get();

            return view('visitor.excel', compact('Visiter', 'Mobile', 'EntryDate'));
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
                $Data = Visitor::where('visiterId', '=', $id)->delete($data);
            }
            echo $Data;
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
