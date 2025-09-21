<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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

            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array|min:2',
            'questions.*.answers.*' => 'required|string',
            'questions.*.correct' => 'required|string',
            'course_id' => 'required|integer|exists:courses,id',
            'lesson_id' => 'required|integer|exists:lessons,id',

        ];
        foreach (config('translatable.locales') as $locale) {
            // $rules += [$locale . '.title' => ['required', 'string']];
        }
        return  $rules;
    }

}