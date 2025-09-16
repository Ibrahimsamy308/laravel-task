<?php

namespace App\Models;

use App\Traits\MorphFile;
use App\Traits\MorphVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;



class Material extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile, MorphVideo;
    protected $table = 'materials';
    public $translatedAttributes = ['title'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        return  $this->file? asset($this->file->url): settings()->logo;
    }

//    public function getVideoAttribute()
//     {
//         return $this->video ? asset($this->video->url) : asset('videos/default.mp4');
//     }

    public function getVideoAttribute()
    {
        return $this->file ? asset($this->file->url) : asset('videos/default.mp4');
    }



    
}