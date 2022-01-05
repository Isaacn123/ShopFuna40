<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;
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
}
