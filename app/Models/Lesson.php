<?php

namespace App\Models;

use App\Traits\MorphFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;



class Lesson extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile;
    protected $table = 'lessons';
    public $translatedAttributes = ['title','description'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        return  $this->file?asset($this->file->url): settings()->logo;
    }


    public function exams()
    {
        return $this->hasMany(Exam::class,);
    }


    public function videos()
    {
        return $this->hasMany(Video::class,);
    }


    
}