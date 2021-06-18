<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'picturePath', 'name', 'description', 'ingredients', 'price', 'rate', 'types'
    ];
}
