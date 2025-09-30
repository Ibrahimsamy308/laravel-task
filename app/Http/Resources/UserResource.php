<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {  
        return [
            "id" => $this->id,
            "image" => $this->image,
            "fullname" => $this->fullname,
            "email" => $this->email,
            "phone" => $this->phone,
            'points'=>$this->points,
            "cart" => $this->cart,
            'courses'  => CourseResource::collection(
                DB::table('courses')
                    ->join('userCourses', 'courses.id', '=', 'userCourses.course_id')
                    ->where('userCourses.user_id', $this->id)
                    ->select('courses.*')
                    ->get()
            ),
        ];
    }
}