<?php

namespace App\Models;

use App\Traits\MorphFile;
use App\Traits\MorphVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;



class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile, MorphVideo;
    protected $table = 'categories';
    public $translatedAttributes = ['title'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        $image = $this->file()->where('type', 'image')->first();
        return $image ? asset($image->url) : settings()->logo;
    }

    public function getVideoAttribute()
    {
        $video = $this->file()->where('type', 'video')->first();
        return $video ? asset($video->url) : asset('videos/default.mp4');
    }



    
}