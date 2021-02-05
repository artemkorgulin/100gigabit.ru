<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    protected $table = 'statuses';
    protected $fillable = [
        'status_id', 'name'
    ];
}
