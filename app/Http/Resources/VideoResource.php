<?php

namespace App\Http\Resources;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            "lesson_id" => $this->lesson_id,
            "url" => $this->url,
            "duration" => $this->duration,
            "provider" => $this->provider,
            "is_active" => $this->is_active,
        ];
    }
}