<?php

namespace App\Models;

use App\Traits\MorphFile;
use App\Traits\MorphVideo;
use App\Traits\MorphMaterials;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



class Material extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile, MorphVideo, MorphMaterials;
    protected $table = 'materials';
    public $translatedAttributes = ['title'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        $image = $this->file()->where('type', 'image')->first();
        return $image ? asset($image->url) : settings()->logo;
    }

//    public function getVideoAttribute()
//     {
//         return $this->video ? asset($this->video->url) : asset('videos/default.mp4');
//     }

    // public function getVideoAttribute()
    // {
    //     return $this->file ? asset($this->file->url) : asset('videos/default.mp4');
    // }

    // public function getMaterialsAttribute()
    // {
    //     return $this->materials->isNotEmpty()
    //         ? $this->materials->map(fn($material) => asset($material->url))->toArray()
    //         : [asset('materials/default.pdf')];
    // }

    public function getMaterialsUrlsAttribute()
    {
        return $this->materials()->exists()
            ? $this->materials()->get()->map(fn($material) => asset($material->url))->toArray()
            : [asset('materials/default.pdf')];
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
    
     protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->createdBy_id = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->createdBy_id = auth()->id();
            }
        });
        static::addGlobalScope('user_scope', function (Builder $builder) {
            if (Auth::check() && Auth::user()->type !== 'admin') {
                $builder->where('createdBy_id', Auth::id());
            }
        });


    }



    
}