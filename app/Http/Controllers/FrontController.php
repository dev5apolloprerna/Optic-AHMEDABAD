<?php

namespace App\Http\Controllers;

use App\Models\BookMyStall;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Visitor;
use App\Models\CityTour;
use App\Models\Media;
use App\Models\City;
use App\Models\OurSponsors;
use App\Models\PhotoGallery;
use App\Models\FloorPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Import QrCode facade
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

use App\Models\Blog;

class FrontController extends Controller
{
     public function privacy_policy()
    {
        return view('frontview.privacy_policy');
    }
     public function terms_condition()
    {
        return view('frontview.term-condition');
    }

     public function blog()
    {
        $blogs = Blog::where([
                'iStatus' => 1,
                'isDelete' => 0
            ])
            ->orderBy('blogId','desc')
            ->paginate(6);
    
        return view('frontview.blog', compact('blogs'));
    }
    

    public function blogdetail($slug)
    {
        // Current Blog
        $blog = Blog::where([
                'strSlug' => $slug,
                'iStatus' => 1,
                'isDelete' => 0
            ])->firstOrFail();
    
        // Related Blogs (exclude current)
        $relatedBlogs = Blog::where('blogId','!=',$blog->blogId)
            ->where([
                'iStatus' => 1,
                'isDelete' => 0
            ])
            ->orderBy('blogId','desc')
            ->limit(3)
            ->get();
    
        return view('frontview.blogdetail', compact('blog','relatedBlogs'));
    }
    
    
    public function index()
    {
        try {
            return view('frontview.index');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function about()
    {
        try {
            return view('frontview.about');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

  

    public function exhibitor_profile()
    {
        try {
            return view('frontview.exhibitor_profile');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

   
    public function visitor_registration()
    {
        try {
            $states = State::orderBy('stateName', 'asc')->get();

            return view('frontview.visitor_registration', compact('states'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    
    public function visitor_registration_store(Request $request)
    {
        $request->validate([
        
            'name'=>'required',
            'email'=>'required|email',
            'companyName'=>'required',
        
            'country_type'=>'required',
        
            'state'=>'required_if:country_type,india',
            'city'=>'required_if:country_type,india',
        
            'country'=>'required_if:country_type,other',
            'overseas_state'=>'required_if:country_type,other',
        
            'visitDate'=>'required',
            'captcha'=>'required|captcha',
            'mobile'=>'required|unique:visiter,mobile'
            
            ], [
            'captcha.captcha'  => 'The captcha you entered is incorrect. Please try again.',
        
        ]);
    
        $ip = $request->ip();
        $today = date('Y-m-d');
    
        $existingCount = DB::table('visiter')
            ->where('strIP', $ip)
            ->whereDate('strEntryDate', $today)
            ->count();
    
        if ($existingCount >= 5) {
            return redirect()->route('FrontIndex');
        }

        // Default values
            $Country = 'India';
            $State = null;
            $City = null;
            
            if ($request->country_type == 'india') {
            
                $Country = 'India';
            
                if ($request->state == "Other") {
                    $State = $request->otherstate;
                } else {
            
                    $stateData = DB::table('state')
                        ->where('stateId', $request->state)
                        ->first();
            
                    $State = $stateData ? $stateData->stateName : null;
                }
            
                $City = ($request->city == "Other" || empty($request->city))
                    ? $request->othercity
                    : $request->city;
            
            } else {
            
                // Overseas
                $Country = $request->country;
                $State = $request->overseas_state;
                $City = null;   // or '-' if you want
            
            }
            
            $data = [
                'name'          => ucwords($request->name),
                'companyName'   => ucwords($request->companyName),
                'email'         => strtolower($request->email),
                'mobile'        => $request->mobile,
            
                'country'       => ucwords($Country),
                'state'         => ucwords($State),
                'city'          => $City ? ucwords($City) : null,
            
                'visitDate'     => $request->visitDate,
                'interested'    => $request->interested,
                'strEntryDate'  => now(),
                'strIp'         => $request->ip(),
            ];
    
        // Insert visitor
        $GetId = DB::table('visiter')->insertGetId($data);
    
        // QR TEXT
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
    
        // Update Visitor
        DB::table('visiter')
            ->where(['isDelete' => 0, 'visiterId' => $GetId])
            ->update([
                'earthconId' => 'OPTIC-' . $GetId,
                'visitRefId' => $GetId,
            ]);
    
        // Email Settings
        $SendEmailDetails = DB::table('sendemaildetails')
            ->where(['id' => 4])
            ->first();
    
        $msg = [
            'FromMail' => $SendEmailDetails->strFromMail,
            'Title' => $SendEmailDetails->strTitle,
            'ToEmail' => $request->email,
            'Subject' => $SendEmailDetails->strSubject
        ];
    
        // Send Mail
        Mail::send(
            'emails.front_visitor_registration',
            [
                'data' => $data,
                'GetId' => $GetId,
                'qrFile' => $qrFile
            ],
            function ($message) use ($msg) {
    
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])
                    ->cc('edit.margi@gmail.com')
                    ->subject($msg['Subject']);
            }
        );
    
        return redirect()->route('visitor_registration_thank_you')->with(['data' => $data,'qrFile' => $qrFile]);
    }

    public function  visitor_registration_thank_you()
    {
        try {
            $data = session('data');
            $qrFile = session('qrFile');
            if ($data) {
                return view('frontview.visitor_registration_thankyou', compact('data','qrFile'));
            } else {
                return redirect()->route('FrontIndex');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function FrontVisitor_Registration_checkmobile(Request $request)
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
    
    
    public function registration()
    {
        try {
            $states = State::orderBy('stateName', 'asc')->where(['istatus' => 1, 'isDelete' => 0])->get();

            return view('frontview.visitor_registration', compact('states'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function visitors_profile()
    {
        try {
            return view('frontview.visitors_profile');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

   

    public function  venue()
    {
        try {
            return view('frontview.venue');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function  floor_plan_new()
    {
        try {
            return view('frontview.floor_plan');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    
    public function  floor_plan_store(Request $request)
    {
        try {
            request()->validate(
                [
                    'name' => 'required',
                    'companyName' => 'required',
                    'email' => 'required',
                    'mobile' => 'required|numeric|digits:10'
                ]
            );
            
            $ip = $request->ip();
            $today = date('Y-m-d');
            
            $existingCount = FloorPlan::where('strIp', $ip)
                ->whereDate('strEntryDate', $today)
                ->count();
            
            // If the count exceeds 5, return an error
            if ($existingCount >= 1) {
                return redirect()->route('FrontIndex');
            }

            $data = array(
                'name' => ucwords($request->name),
                'companyName' => ucwords($request->companyName),
                'email' => strtolower($request->email),
                'mobile' => $request->mobile,
                'strEntryDate' => date('Y-m-d'),
                'created_at' => now(),
                "strIp" => $request->ip()
            );
            
            FloorPlan::create($data);

            return redirect()->route('floor_plan_thank_you');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    
    public function  floor_plan_thank_you()
    {
        try {
            return view('frontview.floor_plan_thank_you');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function contact()
    {
        try {
            return view('frontview.contact');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function  exhibitor_login()
    {
        try {
            return view('frontview.exhibitor_login');
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

    public function mappingcity(Request $request)
{
    $cities = City::where('stateid', $request->state)
                ->orderBy('name', 'asc')
                ->get();

    $html = "<option value=''>Select City</option>";

    foreach ($cities as $city) {
        $html .= "<option value='".$city->name."'>".$city->name."</option>";
    }

    return $html;
}

    public function printrecord(Request $request)
    {
        try {
            $MobileNo = $request->mobile;
            $data = [];
            if ($request->mobile != "") {
                $data = DB::table('visiter')
                    ->where(['isDelete' => 0, 'isSpotRegistration' => 1])
                    ->when($request->mobile, fn ($query, $mobile) => $query
                        ->Where('visiter.mobile', 'LIKE', '%' . $mobile . '%'))
                    ->get();
                // dd($docket);
            }
            return view('printrecordPage', compact('data', 'MobileNo'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function printrecordsubmit(Request $request, $name, $mobile, $state, $city)
    {
        try {
            $Data = array(
                'name' => $name,
                'mobile' => $mobile,
                'state' => $state,
                'city' => $city,
            );

            $pdf = PDF::loadView('printrecord', ['Data' => $Data])->setPaper('a7', 'landscape');

            return $pdf->stream('details.pdf');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    
    public function  book_my_stall(Request $request)
    {
        
        try {
            return view('frontview.book_my_stall');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    
     public function  book_my_stall_store(Request $request)
    {
        try {
            request()->validate(
                [
                    'name' => 'required',
                    'companyName' => 'required',
                    'email' => 'required',
                    'mobile' => 'required|numeric|digits:10',
                    'city' => 'required',
                    'stall_size' => 'required',
                    'message' => 'required',
                ]
            );
            
            $ip = $request->ip();
            $today = date('Y-m-d');
            
            $existingCount = BookMyStall::where('strIp', $ip)
                ->whereDate('strEntryDate', $today)
                ->count();
            
            // If the count exceeds 5, return an error
            if ($existingCount >= 1) {
                return redirect()->route('FrontIndex');
            }

            $data = array(
                'name' => ucwords($request->name),
                'companyName' => ucwords($request->companyName),
                'email' => strtolower($request->email),
                'mobile' => $request->mobile,
                'city' => $request->city,
                'stall_size' => $request->stall_size,
                'message' => $request->message,
                'strEntryDate' => date('Y-m-d'),
                'created_at' => now(),
                "strIp" => $request->ip()
            );
            DB::table('book_my_stall')->insert($data);

            $SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 9])
                ->first();

            $msg = array(
                'FromMail' => $SendEmailDetails->strFromMail,
                'Title' => $SendEmailDetails->strTitle,
                'ToEmail' => $request->email,
                'Subject' => $SendEmailDetails->strSubject
            );

            $mail = Mail::send('emails.book_my_stall', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->cc('edit.margi@gmail.com')->subject($msg['Subject']);
            });

            return redirect()->route('book_my_stall_thank_you')->with(['data' => $data]);
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    
    public function  book_my_stall_thank_you()
    {
        try {
            $data = session('data');
            if ($data) {
                return view('frontview.bookmystall_thankyou', compact('data'));
            } else {
                return redirect()->route('FrontIndex');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
