<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
 
    public function rules()
    {
        //to add or remove input from request in validation class use $this->merge
        //  $this->merge(['user_id' => auth('api')->user()->id]);


        $image = request()->isMethod('put') ? 'nullable' : 'required';

        $rules = [
            'image' =>  $image ,
            'contact_info' =>  [
                'required',
                'string',
                'max:255',
                'regex:/^((\+?\d{10,15}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,})(\s*[,;]\s*(\+?\d{10,15}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}))*)$/i',
            ],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required', 'string']];
        }
        return  $rules;
    }

}