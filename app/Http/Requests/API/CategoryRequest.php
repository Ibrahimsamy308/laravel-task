<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;



class CategoryRequest extends FormRequest
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
        $image = $this->isMethod('put') ? 'nullable' : 'required|image|mimes:jpeg,png,jpg,webp|max:2048';

        $rules = [
            'image' => $image,
            'is_active' => 'nullable|boolean',
        ];

        // multi-language validation
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