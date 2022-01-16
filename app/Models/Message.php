<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'flag'
    ];
}
