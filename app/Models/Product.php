<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     protected $table = 'products';
     protected $appends = ['imagePath'];
     protected $fillable = [
          'name','stock','price', 'description','featured_image','category_id','discount',
          'subCategory_id', 'slug', 'favourites','companyName'
     ];


    public function reviews(){

        return $this->hasMany('App\Models\Review');
    }

    public function getImagePathAttribute()
    {
        // return url('images/business') . '/';
        return url('https://res.cloudinary.com/ivhfizons/image/upload/v1639074703'). '/';
    
    }

    public function subCategory()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    // public function user()
    // {
    //  return $this->has('App\Models\User');
    //     // return $this->hasMany('user_id');
    // }
}
