<?php

namespace App\Traits;

use App\Models\File as ModelsFile;
use Exception;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\File;

trait MorphVideo
{
    public function video(): MorphOne
    {
        return $this->morphOne(ModelsFile::class, 'fileable');
    }

    public function uploadVideo()
    {
        if (request()->hasFile('video')) {
            try {
                $file = request()->file('video');

                // اسم الملف
                $videoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // نقل الملف إلى public/videos
                $file->move(public_path('videos'), $videoName);

                // تخزين الرابط في DB
                $this->video()->create([
                    'url' => 'videos/' . $videoName
                ]);

            } catch (Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with(['error' => __('general.something_wrong')]);
            }
        }
    }

    public function updateVideo()
    {
        if (request()->hasFile('video')) {
            try {
                $this->deleteVideo();

                $file = request()->file('video');
                $videoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('videos'), $videoName);

                $this->video()->create([
                    'url' => 'videos/' . $videoName
                ]);

            } catch (Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with(['error' => __('general.something_wrong')]);
            }
        }
    }

    public function deleteVideo()
    {
        try {
            if ($this->file) {
                $videoPath = public_path($this->file->url);
    
                if (file_exists($videoPath)) {
                    File::delete($videoPath);
                }
    
                $this->file()->delete();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    

    public function getVideoAttribute()
    {
        return $this->video ? asset($this->video->url) : null;
    }
}