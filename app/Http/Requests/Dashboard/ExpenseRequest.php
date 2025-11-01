<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
            'vendor_id'   => ['nullable', 'exists:vendors,id'],
            'amount'      => ['required', 'numeric', 'min:0'],
            'date'        => ['required', 'date'],
        
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.description' => ['required', 'string']];
        }
        return  $rules;
    }

}