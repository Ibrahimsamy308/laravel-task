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
        // dd(DB::table('userCourses')->where('user_id', $this->id)->get());
        return [
            "id" => $this->id,
            "image" => $this->image,
            "fullname" => $this->fullname,
            "email" => $this->email,
            "phone" => $this->phone,
            'points'=>$this->points,
            "cart" => $this->cart,
            'courses' => CourseResource::collection(
             DB::table('courses')
                ->whereIn('id', function($q) {
                    $q->select('course_id')
                    ->from('userCourses')
                    ->where('user_id', $this->id);
                })
                ->get(),
            ),
        ];
    }
}