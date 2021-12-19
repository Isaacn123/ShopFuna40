<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProduct extends Model
{
    use HasFactory;
    protected $table = 'business_product';
    protected $fillable = [
         'name','stock','price', 'description','category_id','discount',
         'subCategory_id'
    ];


   public function reviews(){

       return $this->hasMany('App\Models\Review');
   }
}
