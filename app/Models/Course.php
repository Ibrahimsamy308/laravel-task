<?php

namespace App\Models;

use App\Traits\MorphFile;
use App\Traits\MorphVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;



class Course extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile,MorphVideo;

    protected $table = 'courses';
    public $translatedAttributes = ['title','description','curriculum'];
    protected $guarded = [];
    public $timestamps = true;
     public function getVideoAttribute()
    {
        return $this->file ? asset($this->file->url) : asset('videos/default.mp4');
    }
    public function getImageAttribute(){
        return  $this->file?asset($this->file->url): settings()->logo;
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    
    public function students()
    {
        return $this->belongsToMany(User::class,'userCourses');
    }


    public function lessons()
    {
        return $this->hasMany(Lesson::class,);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class,);
    }
    


    
}