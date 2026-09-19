<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{

    public function state_city_mapping(Request $request)
    {
        try {
            $response = [];

            // ✅ Get all active, non-deleted states
            $states = State::orderBy('stateName', 'asc')
                ->where(['iStatus' => 1, 'isDelete' => 0])
                ->get();

            $response['states'] = $states;

            // ✅ Read stateId from request (not from URL)
            $stateId = $request->input('state_id');

            // ✅ If stateId is provided, fetch its cities
            if (!empty($stateId)) {
                $cities = City::where([
                    'iStateId' => $stateId,
                    'isDelete' => 0,
                ])->orderBy('strCityName', 'asc')->get();
                // dd($cities);

                if ($cities->isEmpty()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cities not found for the selected state',
                    ], 404);
                }

                $response['cities'] = $cities;
            } else {
                // ✅ If no stateId, send all cities (optional)
                $response['cities'] = City::where('isDelete', 0)
                    ->orderBy('strCityName', 'asc')
                    ->get();
            }

            return response()->json([
                'success' => true,
                'data' => $response,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('State-City mapping error: ' . $th->getMessage(), [
                'trace' => $th->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }


    public function visitor_registration(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'companyName' => 'required',
                'state' => 'required',
                'city' => 'required',
                'visitDate' => 'required',
                'mobile' => 'required|unique:visiter,mobile|digits:10',
            ]);

            // Handle state (Other case)
            $state = $request->state === "Other" ? $request->otherstate : $request->state;

            $ip = $request->ip();
            $today = now()->toDateString();

            // IP-based submission limit (max 5 per day)
            $existingCount = Visitor::where('strIp', $ip)
                ->whereDate('strEntryDate', $today)
                ->count();

            if ($existingCount >= 5) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have reached the maximum limit of 5 entries per day from this IP address.'
                ], 429); // 429 = Too Many Requests
            }


            DB::beginTransaction();

            $state = State::where('stateId', $request->state)->first();
            $city =  City::where('iCityId', $request->city)->first();

            // ✅ Use Eloquent Model for insert
            $data = array(
                'name' => ucwords($request->name),
                'companyName' => ucwords($request->companyName),
                'email' => strtolower($request->email),
                'mobile' => $request->mobile,
                'state' => $state->stateName,
                'city' => $city->strCityName,
                'visitDate' => $request->visitDate,
                'interested' => $request->interested,
                'strEntryDate' => now(),
                'strIp' => $ip,
            );
            $visitor = Visitor::create($data);

            // Update Earthcon ID and Reference ID
            Visitor::where('visiterId', $visitor->id)->update([
                'earthconId' => 'OPTIC24_' . $visitor->id,
                'visitRefId' => $visitor->id,
            ]);

            DB::commit();

            // Get email template
            $SendEmailDetails = DB::table('sendemaildetails')->where('id', 4)->first();

            if ($SendEmailDetails) {
                $msg = [
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => $SendEmailDetails->strTitle,
                    'ToEmail' => $request->email,
                    'Subject' => $SendEmailDetails->strSubject,
                ];

                // ✅ Send email
                Mail::send('emails.front_visitor_registration', [
                    'data' => $data,
                    'GetId' => $visitor->id,
                ], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->cc('edit.margi@gmail.com')->subject($msg['Subject']);
                });
            }

            return response()->json([
                'message' => 'Visitor registered successfully.',
                'success' => true,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Visitor registration error: ' . $th->getMessage(), [
                'trace' => $th->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            DB::rollBack();

            return response()->json([
                'error' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
