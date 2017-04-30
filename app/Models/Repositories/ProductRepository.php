<?php

namespace App\Models\Repositories;

use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Model
     */
    protected $product;

    /**
     * ProductRepository constructor.
     * @param Model $product
     */
    public function __construct(Model $product)
    {
        $this->product = $product;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProducts()
    {
        $product = $this->product;

        return $product::all();
    }

    /**
     * @param $lm
     * @return mixed
     */
    public function getProductsByLm($lm)
    {
        $product = $this->product;

        return $product::find($lm);
    }

    /**
     * @param $data
     * @return mixed
     */
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

    /**
     * @param $lm
     * @return bool
     */
    public function delete($lm)
    {
        $productModel = $this->product;

        $product = $productModel::find($lm);

        if($product) {
            return $product->delete();
        }

        return false;
    }
}