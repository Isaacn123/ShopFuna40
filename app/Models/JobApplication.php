<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $fillable = [
       'firstName',
       'lastName',
       'email',
       'phoneNumber',
       'address',
       'jobPositon',
       'zipCode',
       'reference',
       'country',
       'city',
       'resume',
       'description',
       'dateOfBirth'
    ];
}
