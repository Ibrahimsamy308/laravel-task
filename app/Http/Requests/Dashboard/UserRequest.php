<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $image=request()->isMethod('put')?'nullable':'required';
        $email=request()->isMethod('put')?['required','email']:['required','email',Rule::unique('users', 'email')->ignore($this->id)];
        // dd(request()->all());
        return [
            'image' => $image,
            'fullname' => 'required',
            'phone' => 'required|numeric',
            'email' => $email,
            'password' => 'required_without:_method|same:confirm-password',
        ];
    }
}
