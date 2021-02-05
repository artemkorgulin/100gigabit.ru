<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $table = 'additional';
    protected $fillable = [
        'additional_id', 'additional_name', 'additional_price'
    ];
}
