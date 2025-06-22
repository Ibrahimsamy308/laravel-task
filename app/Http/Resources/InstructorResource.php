<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
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
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "type" => $this->type,
            "active" => $this->active,
            "bio" => $this->bio,
            "specialization" => $this->specialization,
            "experience" => $this->experience,
            "facebook" => $this->facebook,
            "instagram" => $this->instagram,
            "twitter" => $this->twitter,
            "linkedin" => $this->linkedin,
            "whatsapp" => $this->whatsapp, 
            'courses_count' => $this->courses()->count(),
            'students_count' => $this->students()->count()
        ];
    }
}