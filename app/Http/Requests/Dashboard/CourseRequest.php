<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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

        $video = $this->isMethod('put') ? 'nullable|mimes:mp4,avi,mov,wmv|max:200000' : 'required|mimes:mp4,avi,mov,wmv|max:200000';

        $rules = [
            'video' => $video,
            'lesson_id' => 'required|integer|exists:lessons,id',
            'duration'  => 'required|numeric|min:1',
            'is_active' => 'required|boolean',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required', 'string']];
            $rules += [$locale . '.description' => ['required']];
        }
        return  $rules;
    }

}