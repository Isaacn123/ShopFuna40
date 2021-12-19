<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategoryname',
        'slug',
        'category_id',
        'category_name',
    ];

   public function categories()
   {
     return $this->belongsTo('App\Models\Category', 'id','id');
   }
}
