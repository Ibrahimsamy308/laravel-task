<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize()
    {
        return true; // الكل يقدر يستخدم الريكوست
    }

    public function rules()
    {
        $video = $this->isMethod(method: 'put') ? 'nullable|mimes:mp4,avi,mov,wmv|max:200000' : 'required|mimes:mp4,avi,mov,wmv|max:200000';

        $rules = [
            'course_id'   => ['required', 'exists:courses,id'], // لازم يختار كورس
            'duration'    => ['required', 'numeric', 'min:1'], // لازم يكون رقم ومش أقل من 1
            'lessonOrder' => ['required', 'integer', 'min:0'], // لازم رقم صحيح
            'is_free'     => ['required', 'boolean'], // لازم يتبعت (hidden input بيضمن كده)
            'video'       => $video,
        ];

        // اللغات كلها (العناوين والوصف)
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = ['required', 'string', 'max:255'];
            $rules[$locale . '.description'] = ['required', 'string'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'course_id.required' => __('validation.required', ['attribute' => __('general.course')]),
            'course_id.exists'   => __('validation.exists', ['attribute' => __('general.course')]),

            'duration.required'  => __('validation.required', ['attribute' => __('general.duration')]),
            'duration.numeric'   => __('validation.numeric', ['attribute' => __('general.duration')]),
            'duration.min'       => __('validation.min.numeric', ['attribute' => __('general.duration'), 'min' => 1]),

            'lessonOrder.required' => __('validation.required', ['attribute' => __('general.order')]),
            'lessonOrder.integer'  => __('validation.integer', ['attribute' => __('general.order')]),
            'lessonOrder.min'      => __('validation.min.numeric', ['attribute' => __('general.order'), 'min' => 0]),

            'is_free.required' => __('validation.required', ['attribute' => __('general.is_free')]),
            'is_free.boolean'  => __('validation.boolean', ['attribute' => __('general.is_free')]),

            // رسائل الترجمة
            '*.title.required'       => __('validation.required', ['attribute' => __('general.title')]),
            '*.title.max'            => __('validation.max.string', ['attribute' => __('general.title'), 'max' => 255]),
            '*.description.required' => __('validation.required', ['attribute' => __('general.description')]),
        ];
    }
}
