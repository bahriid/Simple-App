<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'food_id',
        'quantity',
        'total',
        'status',
        'payment_url'
    ];

    public function food()
    {
        return $this->hasOne(Food::class,'id','food_id');
    }
}
