<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class User extends Model
{
    protected $table = 'permission_user';
    protected $fillable = [
        'permission_id', 'user_id'
    ];
    
}
