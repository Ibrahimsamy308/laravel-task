<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        $video = $this->isMethod(method: 'put') ? 'nullable|mimes:mp4,avi,mov,wmv|max:200000' : 'required|mimes:mp4,avi,mov,wmv|max:200000';

        $rules = [
            'course_id'   => ['required', 'exists:courses,id'], // لازم يختار كورس
            'duration'    => ['required', 'numeric', 'min:1'], // لازم يكون رقم ومش أقل من 1
            'lessonOrder' => ['required', 'integer', 'min:1'], // لازم رقم صحيح
            'is_free'     => ['boolean'], // لازم يتبعت (hidden input بيضمن كده)
            'video'       => $video,
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = ['required', 'string',];
            $rules[$locale . '.description'] = ['required', 'string'];
        }

        return $rules;
    }


}