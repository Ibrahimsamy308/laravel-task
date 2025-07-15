<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;


class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow only authenticated users
    }

    public function rules()
    {
        return [
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->current_password && !Hash::check($this->current_password, Auth::user()->password)) {
            $validator->errors()->add('current_password', 'The current password is incorrect.');
        }
        });
    }
}