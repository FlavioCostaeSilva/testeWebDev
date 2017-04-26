<?php
/**
 * Created by PhpStorm.
 * User: Flávio Costa e Silva
 * Date: 04/03/2017
 * Time: 20:06
 */

namespace App\Models\Services;


use App\Models\Repositories\ProductRepositoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductService implements ProductServiceInterface
{

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function storageAndPreProcessFileUploaded(UploadedFile $file)
    {
        $file->move(storage_path() . '/xlsx', md5(uniqid(time())) . '.xlsx');
    }



}