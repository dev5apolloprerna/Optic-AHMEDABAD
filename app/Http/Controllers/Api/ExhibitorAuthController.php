<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExhibitorUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ExhibitorAuthController extends Controller
{
    /**
     * Exhibitor Login API
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|digits:10',
                'password' => 'required',
            ]);
            // dd($validator);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            $exhibitor = ExhibitorUser::where('Mobile', $request->mobile)->first();
            if (!$exhibitor || !Hash::check($request->password, $exhibitor->strPassword)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid mobile or password.',
                ], 401);
            }
            // dd($exhibitor);

            // Generate JWT token
            $token = JWTAuth::fromUser($exhibitor);

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'token' => $token,
                'data' => [
                    'id' => $exhibitor->id,
                    'company' => $exhibitor->strCompany,
                    'email' => $exhibitor->strEmail,
                    'mobile' => $exhibitor->Mobile,
                    'stall_no' => $exhibitor->strStallNo,
                    'contact_person' => $exhibitor->strContactPerson,
                ]
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Exhibitor Login Error: ' . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    /**
     * Exhibitor Logout
     */
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['success' => true, 'message' => 'Logout successful.']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Failed to logout.'], 500);
        }
    }

    /**
     * Get Exhibitor Profile
     */
    public function profile()
    {
        try {
            $exhibitor = auth()->user();
            return response()->json([
                'success' => true,
                'data' => $exhibitor,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
    }
}
