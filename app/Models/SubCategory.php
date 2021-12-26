<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;
    protected $appends = ['imagePath'];

    protected $fillable = [
        'subcategoryname',
        'slug',
        'category_id',
        'category_name',
    ];

    public function getImagePathAttribute()
    {
        // return url('images/user') . '/';
        return url('https://res.cloudinary.com/ivhfizons/image/upload/v1639074703'). '/';
    }

   public function categories()
   {
     return $this->belongsTo('App\Models\Category', 'id','id');
   }
}
