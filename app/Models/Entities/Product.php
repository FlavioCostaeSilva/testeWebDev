<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models\Entities
 */
class Product extends Model
{
    /** @var bool $timestamps */
    public $timestamps = false;

    /** @var string $primaryKey */
    protected $primaryKey = 'lm';

    /** @var array $fillable */
    protected $fillable = [
        'lm', 'name', 'category', 'free_shipping', 'description', 'price'
    ];

    /**
     * Gets price attribute formatted
     *
     * @param $price
     * @return string
     */
    public function getPriceAttribute($price)
    {
        return number_format($price, 2, '.', '');
    }
}
