<?php

namespace App\Models\Repositories;

use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Model $product)
    {
        $this->product = $product;
    }


    public function getProducts()
    {
        $product = $this->product;

        return $product::all();
    }


    public function updateOrCreateProduct($data)
    {
        $product = $this->product;

        return $product::updateOrCreate(
            ['lm' => $data['lm']],
            [
                'name' => $data['name'],
                'category' => $data['category'],
                'free_shipping' => $data['free_shipping'],
                'description' => $data['description'],
                'price' => $data['price']
            ]
        );
    }
}