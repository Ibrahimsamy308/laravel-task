<?php


namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize()
    {
        return true; // مسموح للجميع (ممكن تزود صلاحيات هنا بعدين)
    }

    public function rules()
    {
        $rules = [
            'course_id'   => ['nullable', 'exists:courses,id'],
            'duration'    => ['required', 'numeric'],
            'lessonOrder' => ['nullable', 'integer'],
            'is_free' => ['boolean'],
        ];

        // الترجمة للغات كلها
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = ['required', 'string', 'max:255'];
            $rules[$locale . '.description'] = ['required', 'string'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'course_id.exists' => __('validation.exists'),
            'duration.required' => __('validation.required', ['attribute' => __('general.duration')]),
            'duration.numeric' => __('validation.numeric', ['attribute' => __('general.duration')]),
            'lessonOrder.integer' => __('validation.integer', ['attribute' => __('general.order')]),

            // Messages for translations
            '*.title.required' => __('validation.required', ['attribute' => __('general.title')]),
            '*.description.required' => __('validation.required', ['attribute' => __('general.description')]),
        ];
    }
}
