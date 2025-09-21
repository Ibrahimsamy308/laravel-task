<?php

namespace App\Traits;

use App\Models\File as ModelsFile;

use Exception;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait  MorphFile
{
    public function file(): MorphOne
    {
        return $this->morphOne(ModelsFile::class, 'fileable')->where('type', 'image');
    }
    public function uploadFile()
    {
        if (request()->hasFile('image')) {
            try{
                $file = request()->file('image');
                $image = request()->image->store('images');
                $file->move('images',  $image);
                $this->file()->create(['url' =>  $image,  'type' => 'image']);
                Image::make($image)
                    ->resize(2400, 1600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($image);
            }catch(Exception $e){
                dd($e->getMessage());
                return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }

        }
    }

    public function updateFile()
    {
        if (request()->hasFile('image')) {
            try{
                $this->deleteFile();
                $file = request()->file('image');
                $image = $file ->store('images');
                $file->move('images', $image);
                $this->file()->create(['url' => $image,  'type' => 'image']);
                Image::make($image)
                    ->resize(2400, 1600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($image);
            }catch(Exception $e){
                dd($e->getMessage());
                return redirect()->back()->with(['error' => __('general.something_wrong')]);
            }

        }
    }

    public function deleteFile()
    {
        try{
                if (isset($this->file)){
                $this->file()->delete();}
                if(file_exists($this->file)){
                    File::delete($this->image);
                }
            }catch(Exception $e){
                dd($e->getMessage());
                return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}