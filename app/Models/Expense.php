<?php

namespace App\Models;

use App\Traits\MorphFile;
use App\Traits\MorphVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Expense extends Model implements TranslatableContract
{
    use HasFactory, Translatable, MorphFile, MorphVideo,SoftDeletes;
    protected $table = 'expenses';
    public $translatedAttributes = ['description'];
    protected $guarded = [];
    public $timestamps = true;

    public function getImageAttribute(){
        $image = $this->file()->where('type', 'image')->first();
        return $image ? asset($image->url) : settings()->logo;
    }    

    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check() ) {
                $model->createdBy_id = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check() ) {
                $model->createdBy_id = Auth::id();
            }
        });
        static::addGlobalScope('user_scope', function (Builder $builder) {
            if (Auth::check() && Auth::user()->type !== 'admin') {
                $builder->where('createdBy_id', Auth::id());
            }
        });
    }


    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'createdBy_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    
}