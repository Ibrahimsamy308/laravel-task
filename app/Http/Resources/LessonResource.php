<?php

namespace App\Http\Resources;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "course_id" => $this->course_id,
            "video_url" => $this->video_url,
            "duration" => $this->duration,
            "lessonOrder" => $this->lessonOrder,
            "is_free" => $this->is_free,
            "exams" =>  ExamResource::collection($this->exams),
            "videos" =>  VideoResource::collection($this->videos),
            "materials" =>  MaterialResource::collection($this->materials),
        ];
    }
}