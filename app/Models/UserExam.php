<?php

namespace App\Models;

use App\Traits\MorphFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;



class UserExam extends Model 
{
    use HasFactory, MorphFile;
    protected $table = 'userExams';
    protected $guarded = [];
    public $timestamps = true;
  

    public function getImageAttribute(){
        return  $this->file?asset($this->file->url): settings()->logo;
    }


    public function exam()
    {
        return $this->belongsTo(Exam::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class,);
    }



    
}