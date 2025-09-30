<?php

namespace App\Models;

use App\Traits\MorphFile;
use App\Traits\MorphVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;




class Course extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile,MorphVideo;

    protected $table = 'courses';
    public $translatedAttributes = ['title','description','curriculum'];
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

    

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    
    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'userCourses',
            'course_id',
            'user_id'
        );
    }
    


    public function lessons()
    {
        return $this->hasMany(Lesson::class,);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class,);
    }
    
    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check() && Auth::user()->type != 'admin') {
                $model->admin_id = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check() && Auth::user()->type != 'admin') {
                $model->admin_id = Auth::id();
            }
        });
        static::addGlobalScope('user_scope', function (Builder $builder) {
            if (Auth::check() && Auth::user()->type !== 'admin') {
                $builder->where('admin_id', Auth::id());
            }
        });
    }


    
}