<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videoads extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'username',
       'name',
       'videoadd',
       'supply'
    ];
}
