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
    $video = $this->isMethod(method: 'put') ? 'nullable|mimes:mp4,avi,mov,wmv|max:200000' : 'required|mimes:mp4,avi,mov,wmv|max:200000';


    $rules = [
        'price'          => 'required|numeric|min:0',
        'discount'       => 'nullable|numeric|min:0|max:100',
        'start_date'     => 'required|date',
        'end_date'       => 'required|date|after_or_equal:start_date',
        'duration_hours' => 'required|numeric|min:1',
        'level'          => 'required|string|in:beginner,intermediate,advanced',
        'active'      => 'boolean',
        'video' => $video,
        
    ];

    foreach (config('translatable.locales') as $locale) {
        $rules[$locale . '.title'] = ['required', 'string'];
        $rules[$locale . '.description'] = ['required', 'string'];
    }

    return $rules;
}

}