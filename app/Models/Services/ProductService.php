<?php
/**
 * Created by PhpStorm.
 * User: Flávio Costa e Silva
 * Date: 04/03/2017
 * Time: 20:06
 */

namespace App\Models\Services;


use App\Models\Entities\Product;
use App\Models\Repositories\ProductRepository;
use App\Models\Repositories\ProductRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductService implements ProductServiceInterface
{

    protected $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository(new Product());
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function storageFileUploaded(UploadedFile $file)
    {
        $filename =  md5(uniqid(time())) . '.xlsx';
        $file->move(storage_path() . '/xlsx', $filename);

        return $filename;
    }

    public function processFileWithProducts($filename)
    {
        $rowsTable = $this->obtainRowsOfFileWithProducts($filename);

        if (!empty($rowsTable)) {
            foreach ($rowsTable as $rowTable) {
                $this->createOrUpdateProduct($rowTable);
            }
        }
    }

    private function obtainRowsOfFileWithProducts($filename)
    {
        $rows = Excel::selectSheetsByIndex(0)->load(storage_path() . '/xlsx/' . $filename, function ($reader) {

        })->get()->toArray();

        return $rows;
    }

    private function createOrUpdateProduct($product)
    {
        $this->productRepository->updateOrCreateProduct($product);
    }
}