<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     protected $table = 'products';
     protected $fillable = [
          'name','stock','price', 'description','category_id','discount',
          'subCategory_id'
     ];


    public function reviews(){

        return $this->hasMany('App\Models\Review');
    }
}
