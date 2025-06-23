<?php

namespace App\Models;

use App\Traits\MorphFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;



class Course extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile;
    protected $table = 'courses';
    public $translatedAttributes = ['title','description','curriculum'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        return  $this->file?asset($this->file->url): settings()->logo;
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class,);
    }


    
}