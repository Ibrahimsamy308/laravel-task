<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register','socialLogin','verifyOtp']]);
    }
    /**
     * Get a Passport via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return validationFailedResponse($validator->errors());
        }
    
        $credentials = $request->only('email', 'password');
    
        if (!Auth::guard('admin')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => __('general.invalid_credentials')
            ], 401);
        }
    
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();
    
        if (isset($admin->is_verified) && !$admin->is_verified) {
            return response()->json(['message' => __('general.account_must_be_verified')], 403);
        }
    
        $token = $admin->createToken('AdminToken')->accessToken;
    
        $admin->update([
            'fcm_token' => $request->fcm_token,
            'app_lang'  => $request->app_lang ?? 'en',
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token,
            'admin' => $admin,
        ]);
    }


    /**
     * Register a Admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        $user = auth('api')->user();

        if ($user) {
            $token = $user->token();
            $token->revoke();

            return response()->json(['message' =>  __('general.customer_signed_out')]);
        }

        return response()->json(['message' =>  __('general.no_user_authenticated')], 401);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        $user = Auth::user();
        $token = $user->createToken('API Token')->accessToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
        ]);
    }
    /**
     * Get the authenticated Admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }

}