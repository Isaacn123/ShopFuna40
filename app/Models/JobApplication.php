<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $appends = ['imagePath'];
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
       'dateOfBirth',
       'jobTitle',
       'job_id',
       'company_name',
       'path'
    ];

    public function getImagePathAttribute()
    {
        // return url('images/business') . '/';
        return url('https://res.cloudinary.com/ivhfizons/image/upload/v1639074703'). '/';
    
    }
}
