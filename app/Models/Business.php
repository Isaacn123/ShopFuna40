<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $appends = ['imagePath'];
    protected $table = 'business';
    public $primaryKey = 'id';
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'website',
        'slug',
        'andress',
        'email',
        'contact',
        'code',
        'zipcode',
        'categoryName',
        'subcategoryName',
        'country',
        'fax',
        'city',
        'image',
        'featured_business',
        'featured_image'
    ];


    public function getImagePathAttribute()
    {
        // return url('images/business') . '/';
        return url('https://res.cloudinary.com/ivhfizons/image/upload/v1639074703'). '/';
    
    }

    public function featuredQuery($query)
{
    return $query->where('featured_business', '=', '1');
}

public function User()
    {
        return $this->hasMany('App\Models\User');
    }
}
