<?php

namespace App\Http\Resources;

use App\Models\Exam;
use App\Models\UserExam;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        Auth::shouldUse('api');
        $user = Auth::user(); 

        $userExam = null;

        if ($user) {
            $userExam = UserExam::where('user_id', $user->id)
                ->where('exam_id', $this->id)
                ->first();
        }
            
        return [
            "id" => $this->id,
            "title" => isset($this->lesson->title)? $this->lesson->title:'' . ' - ' . __('general.exam'),
            "course_id" => $this->course_id,
            "lesson_id" => $this->lesson_id,
            "questions" => $this->questions,
            "userExam" => $userExam ? [
                "answers" => $userExam->answers,     
                "score" => $userExam->score,
                "submitted_at"=>$userExam->created_at->translatedFormat('d M Y - h:i A')

            ] : null,
        ];
    }
}