<?php

namespace App\Models;

use App\Traits\MorphFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



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
        $image = $this->file()->where('type', 'image')->first();
        return $image ? asset($image->url) : settings()->logo;
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