<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Traits\MorphVideo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Video extends Model implements TranslatableContract
{
    use HasFactory, Translatable,MorphVideo;

    protected $table = 'videos';
    protected $guarded = [];
    public $translatedAttributes = ['title','description'];
    public $timestamps = true;

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function getVideoAttribute()
    {
        $video = $this->file()->where('type', 'video')->first();
        return $video ? asset($video->url) : asset('videos/default.mp4');
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



    public function users()
    {
        return $this->belongsToMany(User::class, 'uservideos')
        ->withPivot('watched_at') 
        ->withTimestamps();
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,);
    }

    
    
}