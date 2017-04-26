<?php
/**
 * Created by PhpStorm.
 * User: Flávio Costa e Silva
 * Date: 02/01/2017
 * Time: 15:40
 */

namespace App\Models\Repositories;


interface ProductRepositoryInterface
{
    public function getProducts();

    public function insertProducts($data);

    public function updateProduct($lm, $data);
}