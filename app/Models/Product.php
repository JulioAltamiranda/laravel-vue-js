<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'date',
        'time',
        'user_id'
    ];
    protected $table = 'prdcts';
    public $timestamps = false;
}
