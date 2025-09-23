<?php

namespace App\Models;

use App\Traits\MorphFile;
use App\Traits\MorphVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



class Lesson extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile,MorphVideo;
    protected $table = 'lessons';
    public $translatedAttributes = ['title','description'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        return  $this->file?asset($this->file->url): settings()->logo;
    }
    public function getVideoAttribute()
    {
        $video = $this->file()->where('type', 'video')->first();
        return $video ? asset($video->url) : asset('videos/default.mp4');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class,);
    }


    public function videos()
    {
        return $this->hasMany(Video::class,);
    }

    public function materials()
    {
        return $this->hasMany(Material::class,);
    }
    // App\Models\Lesson.php

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
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
