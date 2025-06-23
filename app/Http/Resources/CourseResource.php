<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            "image" => $this->image,
            "title" => $this->title,
            "description" => $this->description,
            "curriculum" => $this->curriculum,
            "instructor" => new InstructorResource($this->admin),
            "price" => $this->price,
            "discount" => $this->discount,
            "active" => $this->active,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "duration_hours" => $this->duration_hours,
            "type" => $this->type,
            "level" => $this->level,
            "introVideo" => $this->introVideo,
            "language" => $this->language,
            "updated_at" => $this->updated_at? $this->updated_at->translatedFormat('j F Y'): null,
            'students_count' => $this->students()->count(),
            'lessons_count' => $this->lessons()->count(),
            'exam_count' => $this->exams()->count(),

        ];
    }
}