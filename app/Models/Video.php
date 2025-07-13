<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
class Video extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $table = 'videos';
    protected $guarded = [];
    public $translatedAttributes = ['title','description'];
    public $timestamps = true;

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,);
    }
    
}