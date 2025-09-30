<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserRequest;
use App\Http\Requests\API\ChangePasswordRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\File as ModelsFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;



class UserController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->middleware('auth:api');
        $this->user = $user;
    }


    public function userProfile() {
        return response()->json(new UserResource(auth('api')->user()));
    }

    public function update(UserRequest $request)
    {
        $user = Auth::user();
        
        if (is_null($user->email)) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                
            ]);
            if($validator->fails()){
                return validationFailedResponse($validator->errors());
                throw new ValidationException($validator,$response);
            }
        }
    
        $data = ($user->email === null) ? $request->except(['image', 'profile_avatar_remove']) : $request->except(['image', 'profile_avatar_remove', 'email']);
        $user->update($data);

        if ($request->hasFile('image')) {
            if ($user->file) {
                $oldImagePath = public_path($user->file->url);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $user->file()->delete();
            }

            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $imagePath = 'images/' . $imageName;
            $file->move(public_path('images'), $imageName);

            $user->file()->create(['url' => $imagePath]);
        }

        return response()->json([
            'status' => true,
            'message' => __('general.profile_updated'),
            'data' => new UserResource($user->refresh())
        ], 200);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'message' => __('general.password_changed')
        ], 200);
    }

    public function customerBlock()
    {
        $customer = User::find(Auth::user()->id);
        $customer->status = 3;
        $customer->save();
        return response()->json([], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLang(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->app_lang = $request->app_lang;
            $user->save();
        }
        return response()->json([], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateFCMToken(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->fcm_token = $request->fcm_token;
            $user->save();
        }
        return response()->json([], 200);
    }


    public function transactions(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'per_page' => 'integer|min:1|max:100',
            ]);
    
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                $errors['message'] = 'Validation Error';
                return response()->json(['errors' => $errors], 420);
            }
            
            $perPage = $request->input('per_page', 10);
            
           
            $transactions = auth()->user()->transactions()->paginate($perPage);
            
            $data = TransactionResource::collection($transactions);
            
            $pagination = [
                'current_page' => $transactions->currentPage(),
                'per_page' => $transactions->perPage(),
                'last_page' => $data->lastPage(),
                'total_items' => $transactions->total(),
            ];
            
            return response()->json(['pagination' => $pagination, 'data' => $data], 200);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }


}