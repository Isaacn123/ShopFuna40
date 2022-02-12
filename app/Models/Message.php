<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Message extends Model
{ 
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'email',
        'guest_id',
        'user_id',
        'subject',
        'profileurl',
        'product_user',
        'product_id',
        'product_name',
        'product_image',
        'flag'
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
