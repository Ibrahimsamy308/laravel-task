<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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


        $image = request()->isMethod('put') ? 'nullable' : 'required';
        $video = $this->isMethod('put') ? 'nullable|mimes:mp4,avi,mov,wmv|max:200000' : 'required|mimes:mp4,avi,mov,wmv|max:200000';

        $rules = [
            // 'image' =>  $image ,
            // 'video' => $video,
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required', 'string']];
        }
        return  $rules;
    }

}