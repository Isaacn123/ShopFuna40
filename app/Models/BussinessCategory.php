<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinessCategory extends Model
{
    use HasFactory;
    protected $fillable = [
         'name',
         'featured_image',
         'slug'
    ];

    public function subCategory(){
     return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    }
}
