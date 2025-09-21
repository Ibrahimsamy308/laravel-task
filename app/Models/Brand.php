<?php

namespace App\Models;

use App\Traits\MorphFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;



class Brand extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile;
    protected $table = 'brands';
    public $translatedAttributes = ['title','description'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        $image = $this->file()->where('type', 'image')->first();
        return $image ? asset($image->url) : settings()->logo;
    }
    
    public function products(){
        return $this->hasMany(Product::class);
    }
    
}