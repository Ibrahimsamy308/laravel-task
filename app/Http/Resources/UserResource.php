<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {  
        dd($this->courses);
        return [
            "id" => $this->id,
            "image" => $this->image,
            "fullname" => $this->fullname,
            "email" => $this->email,
            "phone" => $this->phone,
            'points'=>$this->points,
            "cart" => $this->cart,

           
            // "courses" => CourseResource::collection(),
        ];
    }
}