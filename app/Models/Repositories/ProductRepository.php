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

        $product =
            $product::all();

        if ($product->count() > 0) {
            return $product;
        }

        return null;
    }


    public function insertProducts($data)
    {
        $product = $this->product;

        $product::create($data);
    }


    public function updateProduct($lm, $data)
    {
        $product = $this->product;

        $product = $product::find($lm);

        $product->lm = $data['lm'];
        $product->name = $data['name'];
        $product->category = $data['category'];
        $product->free_shipping = $data['free_shipping'];
        $product->description = $data['description'];
        $product->price = $data['price'];

        $product->update();
    }
}