<?php

namespace App\Models\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository
 * @package App\Models\Repositories
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Model
     */
    protected $product;

    /**
     * ProductRepository constructor.
     *
     * @param Model $product
     */
    public function __construct(Model $product)
    {
        $this->product = $product;
    }

    /**
     * Gets all products on database
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProducts()
    {
        $product = $this->product;

        return $product::all();
    }

    /**
     * Get products by "Lm" attribute
     *
     * @param int $lm
     * @return mixed
     */
    public function getProductsByLm($lm)
    {
        $product = $this->product;

        return $product::find($lm);
    }

    /**
     * Update or create product
     * Update existing products and creates new ones too
     *
     * @param array $data
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
     * Delete product
     * Makes "Hard Delete" of a product in the database
     *
     * @param int $lm
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