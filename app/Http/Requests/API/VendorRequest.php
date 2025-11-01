<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;



class VendorRequest extends FormRequest
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
        $image = $this->isMethod('put') 
            ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' 
            : 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';

        $rules = [
            'image' => $image,
            'contact_info' => [
                'required',
                'string',
                'max:255',
                'regex:/^((\+?\d{10,15}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,})(\s*[,;]\s*(\+?\d{10,15}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}))*)$/i',
            ],
            'is_active' => 'nullable|boolean',
        ];

        // Multi-language validation (title required for each locale)
        foreach (config('translatable.locales') as $locale) {
            $rules["{$locale}.title"] = ['required', 'string', 'max:255'];
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