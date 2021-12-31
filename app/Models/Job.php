<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'salary',
        'slug',
        'country',
        'city',
        'company',
        'companyWebsite',
        'email',
        'phone',
        'zipcode',
        'jobType',
        'address',
        'position_1',
        'position_2',
        'position_3',
        'companyAbbreviation',
        'jobPositions',
        'description',
        'companyLogo',
    ];
}
