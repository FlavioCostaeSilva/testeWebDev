<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'lm';

    protected $fillable = [
        'lm', 'name', 'category', 'free_shipping', 'description', 'price'
    ];
}
