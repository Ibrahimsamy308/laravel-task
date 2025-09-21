<?php

namespace App\Models;

use App\Traits\MorphFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;



class Faq extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile;
    protected $table = 'faqs';
    public $translatedAttributes = ['title', 'subtitle', 'description'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        $image = $this->file()->where('type', 'image')->first();
        return $image ? asset($image->url) : settings()->logo;
    }
    
}