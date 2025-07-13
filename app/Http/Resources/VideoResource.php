<?php

namespace App\Http\Resources;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        Auth::shouldUse('api'); 

        $user = Auth::user();
        $watched = null;

        if ($user) {
            $videoPivot = $user->videos() ->withPivot(['watched_at'])->where('video_id', $this->id)->first();
            // dd($videoPivot->pivot->watched_at);
            if ($videoPivot) {
                $watched = [
                    "status" => true,
                    "watched_at" => Carbon::parse($videoPivot->pivot->watched_at)->translatedFormat('d M Y - h:i A'),
                ];
            }
        }
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "lesson_id" => $this->lesson_id,
            "url" => $this->url,
            "duration" => $this->duration,
            "provider" => $this->provider,
            "is_active" => $this->is_active,
            "watched" => $watched,
        ];
    }
}