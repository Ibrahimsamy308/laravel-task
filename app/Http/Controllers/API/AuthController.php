<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        if($validator->fails()){
            return validationFailedResponse($validator->errors());
            throw new ValidationException($validator,$response);
        }
        $credentials = $request->only('email', 'password');

        // Use the default guard for username/password authentication
        if (Auth::attempt($credentials)) {
            // Generate the access token using Passport
            $user = Auth::user();

            if($user && $user->status == 3){
                return failedResponse(__('general.account_deleted'));
            }
            
            if (!$user->is_verified) {
                return response()->json(['success' => false, 'message' => __('general.account_must_be_verified')], 403);
            }

            $token = $user->createToken('API Token')->accessToken;

            $user->fcm_token = $request->fcm_token;
            $user->app_lang = $request->app_lang??'en';
            $user->save();

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
            ]);
        }

        return failedResponse(__('general.invalid_credentials'));

    }


    public function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid' => 'required',
            'fcm_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 420);
        }

        $user = User::where('uuid', $request->uuid)->first();
        if($user && $user->status == 3){
            return response()->json(['deleted' => true, 'phone' => $request->phone], 406);
        }
        if ($user) {
            $user->fcm_token = $request->fcm_token;
            $user->save();

            
            $token = $user->createToken('API Token')->accessToken;
            return response()->json(['token' => $token, 'info' => $user], 200);
        } 
        else 
        {
            $data=$request->all();
            $data['is_verified']=1;
            $user=User::create($data);
            if ($user)
            {
                $user->fcm_token = $request->fcm_token;
                $user->save();
    
                $token = $user->createToken('API Token')->accessToken;
                
                return response()->json(['token' => $token, 'info' => $user], 200);
            }
        }
}

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'phone' => 'nullable|numeric|unique:users,phone',
            'password' => 'required|string|confirmed|min:6',
        ]);
    
        if ($validator->fails()) {
            return validationFailedResponse($validator->errors());
        }
    
        // $otp = rand(100000, 999999);
        // $user = User::where('email', $request->email)->first();
    
        // if ($user) {
        //     if ($user->is_verified) {
        //         return validationFailedResponse([
        //             'email' => [__('validation.unique', ['attribute' => __('general.email')])]
        //         ]);
        //     }
    
            // $user->update(['otp_code' => $otp]);
            // $user->notify(new OtpNotification($otp));
    
        //     return response()->json([
        //         'success' => true,
        //         'message' => __('general.verification_code_resent'),
        //     ]);
        // }
    
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            // 'otp_code' => $otp,
            'is_verified' => true,
            'fcm_token' => $request->fcm_token,
            'app_lang' => $request->app_lang ?? 'en',
        ]);
    
        // $user->notify(new OtpNotification($otp));
    
        // return response()->json([
        //     'success' => true,
        //     'message' => __('general.account_created_verify_email'),
        // ]);

        $token = $user->createToken('access_token')->accessToken;

        return response()->json([
            'success' => true,
            'message' => __('general.account_created_successfully'),
            'token' => $token,
            'user' => $user
        ]);
    }
    
    public function verifyOtp(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp_code' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->where('otp_code', $request->otp_code)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => __('general.invalid_otp')], 400);
        }

       
        $user->is_verified = true;
        $user->otp_code = null; 
        $user->save();

        
        Auth::login($user);
        $token = $user->createToken('API Token')->accessToken;

        return response()->json([
            'success' => true,
            'message' => __('general.account_verified_success'),
            'token' => $token,
            'user' => $user
        ]);
    }


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
     * Get the authenticated User.
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