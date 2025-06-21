<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Submodule;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use ReflectionClass;
use Illuminate\Support\Facades\Route;
use App\Models\Module;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\PermissionServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class AuthenticationController extends Controller
{
    /** Success Response */
    public static $successStatus = 200;

    /** Unauthorized Request */
    public static $unauthorizedStatus = 401;

    /** Unauthorized Forbidden */
    public static $forbiddenStatus = 403;

    /** Unprocessable Entity */
    public static $validationErrorStatus = 422;

    public function register(Request $request)
    {

        $inputs = $request->all();

        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ];

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {

            $response =
                [
                    'error' => $validator->errors(),
                    'message' => 'Unprocessable Entity.'
                ];

            return response()->json($response, self::$validationErrorStatus);
        };

        $inputs['password'] = bcrypt($inputs['password']);

        $user = User::create($inputs);

        $accessToken = $user->createToken('auth_token')->plainTextToken;

        $data =
            [
                'user' => $user,
                'access_token' => $accessToken
            ];

        $response =
            [
                'success' => true,
                'data' => $data,
                'message' => 'User Registered Successfully.'
            ];

        return response()->json($response, self::$successStatus);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {

            /** @var \App\Models\User $user **/
            $user = Auth::user();

            $accessToken = $user->createToken('auth_token')->plainTextToken;
            /** With Abilities */
            // $accessToken = $user->createToken('auth_token', ['create', 'view', 'update'])->plainTextToken;
            // Check 
            // $request->user()->tokenCan('update') return bool true or false

            $data =
                [
                    'token_type' => 'Bearer',
                    'access_token' => $accessToken,
                    'user' => $user
                ];

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Login Successful.'
            ];

            return response()->json($response, self::$successStatus);
        }

        /** Failed Attempt By Default */

        $errorResponse =
            [
                'error' => true,
                'message' => 'Unathorized Access.',
            ];

        $response = [
            'error' => $errorResponse,
        ];

        return response()->json($response, self::$unauthorizedStatus);
    }

    public function getUserDetails(Request $request)
    {

        // self::throwAuthenticationExceptionForApiRoutes($request);

        $user = $request->user();

        $lastAccessToken  = $user->tokens()->latest()->first()->token;

        $currentAccessToken =  $user->currentAccessToken()->token;

        $data =
            [
                'user' => $user,
                'current_access_token_hash_value' => $currentAccessToken,
                'last_access_token_hash_value' => $lastAccessToken
            ];

        $response =
            [
                'success' => true,
                'data' => $data,
                'message' => 'User is Valid.'
            ];

        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {

        $user = $request->user();

        $user->currentAccessToken()->delete();

        $response =
            [
                'success' => true,
                'message' => 'User Logged Out Successfully.'
            ];

        return response()->json($response, self::$successStatus);
    }

    public function logoutFromAllDevices(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        $response =
            [
                'success' => true,
                'message' => 'User Logged Out Successfully From All Devices.'
            ];

        return response()->json($response, self::$successStatus);
    }

    public function refreshToken(Request $request)
    {

        $user = $request->user();

        $user->currentAccessToken()->delete();

        $newAccessToken = $user->createToken('auth_token')->plainTextToken;

        $data =
            [
                'token_type' => 'Bearer',
                'access_token' => $newAccessToken,
                'user' => $user
            ];

        $response =
            [
                'success' => true,
                'data' => $data,
                'message' => 'New Access Token generated.'
            ];

        return response()->json($response, self::$successStatus);
    }

    public static function throwAuthenticationExceptionForApiRoutes(Request $request)
    {
        if (! $request->user() || ! $request->user()->currentAccessToken()) {
            throw new AuthenticationException;
        }
    }
}
