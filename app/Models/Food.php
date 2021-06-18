<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'picturePath', 'name', 'description', 'ingredients', 'price', 'rate', 'types'
    ];
}
