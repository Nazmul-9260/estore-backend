<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\GenerateOtpApiRequest;
use App\Http\Requests\Api\VerifyOtpApiRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CustomerResource;

class CustomerAuthController extends Controller
{
    public $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function generateCustomer($userId, $authMethod)
    {
        $customerAlreadyExists = Customer::query()->where('user_id', $userId)->first();
        if ($customerAlreadyExists) {
            return $customerAlreadyExists->id;
        } else {
            $customer = new Customer();
            $customer->user_id = $userId;
            $customer->auth_method = $authMethod;
            $customer->save();
            return $customer->id;
        }
    }

    public function generateOtp(GenerateOtpApiRequest $request)
    {
        if ($request->has(['user_id', 'auth_method'])) {
            $customerId = $this->generateCustomer($request->user_id, $request->auth_method);
            $otpGenerated = $this->otpService->generateOtp($customerId);
            if ($otpGenerated) {
                $data =
                    [
                        'user_id' => $request->user_id,
                        'auth_method' => $request->auth_method,
                        'otp_code' => $otpGenerated
                    ];
                $response =
                    [
                        'status' => 'success',
                        'data' => $data,
                        'success' => true,
                        'message' => 'OTP generated and sent to ' . $request->user_id
                    ];

                return response()->json($response, 200);
            } else {
                $response =
                    [
                        'status' => 'error',
                        'error' => true,
                        'message' => 'OTP generation failed for ' . $request->user_id
                    ];
                return response()->json($response, 400);
            }
        } else {
            $response =
                [
                    'status' => 'error',
                    'error' => true,
                    'message' => 'Request is not valid ' . $request->user_id
                ];
            return response()->json($response, 400);
        }
    }

    public function verifyOtp(VerifyOtpApiRequest $request)
    {

        if ($request->has(['user_id', 'otp_code'])) {
            $userId = $request->user_id;
            $customer = Customer::where('user_id', $userId)->first();
            $otp = null;
            if ($customer) {
                $otp = Otp::where('customer_id', $customer->id)->orderBy('created_at', 'desc')->first();
            } else {
                $response =
                    [
                        'status' => 'error',
                        'error' => true,
                        'message' => 'OTP verification failed'
                    ];
                return response()->json($response, 400);
            }
            $otpCode = $otp->otp_code;
            $expiresAt = $otp->expires_at;
            $now = Carbon::now()->timezone('Asia/Dhaka');
            //if ($request->otp_code == $otpCode) valid
            //if ($otp->expires_at > Carbon::now()->timezone('Asia/Dhaka')) valid not expired else expired
            $equal = null;
            $expired = null;
            if ($request->otp_code == $otpCode) {
                $equal = true;
            } else {
                $equal = false;
            }
            if ($otp->expires_at > Carbon::now()->timezone('Asia/Dhaka')) {
                $expired = false;
            } else {
                $expired = true;
            }
            if ($equal && !$expired) {
                // Verified
                $customer->status = 1;
                $customer->is_verified = 1;
                $customer->save();
                // Generate Token and Send to user
                $accessToken = $customer->createToken('auth_token')->plainTextToken;
                $data =
                    [
                        'customer' => $customer,
                        'access_token' => $accessToken,
                        'expires_at' => $expiresAt,
                        'now' => $now,
                        // 'equal' => $equal,
                        // 'expired' => $expired
                    ];

                $response =
                    [
                        'status' => 'success',
                        'data' => $data,
                        'message' => 'OTP verified and customer log in successfull.'
                    ];

                return response()->json($response, 200);
            } else {
                $response =
                    [
                        'status' => 'error',
                        'error' => true,
                        'message' => 'OTP verification failed'
                    ];
                return response()->json($response, 400);
            }
        } else {
            $response =
                [
                    'status' => 'error',
                    'error' => true,
                    'message' => 'Request is not valid ' . $request->user_id
                ];
            return response()->json($response, 400);
        }
    }

    public function getCustomerDetails(Request $request)
    {

        //return "OK";
        //return $request->headers->all();
        //$authorizationHeader = $request->header('Authorization');
        // return $authorizationHeader;

        $customer = $request->user();
        $customer->load(['customerDetails', 'customerAddress']);
        $data =
            [
                'customer' => CustomerResource::make($customer),
            ];

        $response =
            [
                'status' => 'success',
                'message' => 'Customer Details are Fetched Successfully.',
                'data' => $data

            ];

        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        $customer = $request->user();

        $confirmed = $customer->currentAccessToken()->delete();

        if ($confirmed) {
            return new JsonResponse(
                [

                    'status' => 'success',
                    'success' => true,
                    'message' => 'Logout Successfull.',
                    'confirmed' => $confirmed
                ],
                200
            );
        } else {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'error' => true,
                    'message' => 'Logout Failed.',
                    'confirmed' => $confirmed
                ],
                422
            );
        }
    }

    public function logoutAllDevices(Request $request)
    {
        $customer = $request->user();

        $confirmed = $customer->tokens()->delete();

        if ($confirmed) {
            return new JsonResponse(
                [

                    'status' => 'success',
                    'success' => true,
                    'message' => 'Logout From All Devices Successfull.',
                    'confirmed' => $confirmed
                ],
                200
            );
        } else {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'error' => true,
                    'message' => 'Logout From All Devices Failed.',
                    'confirmed' => $confirmed
                ],
                422
            );
        }
    }

    public function login()
    {
        return response()->json(['status' => 'success', 'data' => []], 200);
    }
}
