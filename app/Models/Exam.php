<?php

namespace App\Models;

use App\Traits\MorphFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;



class Exam extends Model 
{
    use HasFactory, MorphFile;
    protected $table = 'exams';
    public $translatedAttributes = ['title'];
    protected $guarded = [];
    public $timestamps = true;
    
    // protected $casts = [
    //     'questions' => 'array',
    // ];

    public function getImageAttribute(){
        return  $this->file?asset($this->file->url): settings()->logo;
    }

    public function users()
    {
        return $this->belongsToMany(User::class,);
    }

    public function course()
    {
        return $this->belongsTo(Course::class,);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,);
    }



    
}