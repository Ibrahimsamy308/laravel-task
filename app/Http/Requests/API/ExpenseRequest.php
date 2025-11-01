<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;



class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
            'vendor_id'   => ['nullable', 'exists:vendors,id'],
            'amount'      => ['required', 'numeric', 'min:0.01'], 
            'date'        => ['required', 'date'],
            'is_active'   => ['nullable', 'boolean'],
            'image'  => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,docx,webp', 'max:4096'],
        ];

        // multi-language description (required at least in default locale)
        foreach (config('translatable.locales') as $locale) {
            $rules["{$locale}.description"] = ['required', 'string', 'max:1000'];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422);
    
        throw new ValidationException($validator, $response);
    }
    


    
}