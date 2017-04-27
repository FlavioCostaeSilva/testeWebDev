<?php

namespace App\Models\Repositories;

use App\Models\Entities\Product;


class ProductRepository implements ProductRepositoryInterface
{

    protected $product;

    public function __construct()
    {
        $this->product = new Product();
    }


    public function getProductByLm($lm)
    {
        $product = $this->product;

        $product =
            $product::where('lm', '=' , $lm)->firstOrFail();

        if ($product) {
            return true;
        }

        return false;
    }


    public function updateOrCreateProduct($data)
    {
        $product = $this->product;

        return $product::updateOrCreate(
            ['lm' => $data['lm']],
            $data
        );
    }
}