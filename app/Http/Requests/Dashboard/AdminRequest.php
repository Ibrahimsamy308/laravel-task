<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the admin is authorized to make this request.
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
        $email=request()->isMethod('put')?['required','email']:['required','email',Rule::unique('admins', 'email')->ignore($this->id)];
        $phone= request()->isMethod('put')? ['required', 'digits:11', Rule::unique('admins', 'phone')->ignore($this->id)]: ['required', 'digits:11', Rule::unique('admins', 'phone')];
           
         // dd(request()->all());
        return [
            'image' => $image,
            'name' => 'required',
            'phone' => $phone,
            'email' => $email,
            'password' => 'required_without:_method|same:confirm-password',
            'roles'    => 'required|string|exists:roles,name',

        ];
    }
}