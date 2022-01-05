<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;
    protected $appends = ['imagePath'];
    protected $fillable = [
        'firstName',
        'lastName',
         'about',
         'email',
         'phone',
         'slug',
         'pdf_file',
         'profession',
         'location',
         'zipcode'
 ];

 public function getImagePathAttribute()
    {
        // return url('images/business') . '/';
        return url('https://res.cloudinary.com/ivhfizons/image/upload/v1639074703'). '/';
    
    }
}
