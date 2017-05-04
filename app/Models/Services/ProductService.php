<?php
namespace App\Models\Services;


use App\Models\Entities\Product;
use App\Models\Repositories\ProductRepository;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ProductService
 * @package App\Models\Services
 */
class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * ProductService constructor.
     */
    public function __construct()
    {
        $this->productRepository = new ProductRepository(new Product());
    }

    /**
     * Name and storage a received file
     * Give a name and storage the .xlsx file in the /storage/xlsx path
     * @param UploadedFile $file
     * @return string
     */
    public function storageFileUploaded(UploadedFile $file)
    {
        $filename = md5(uniqid(time())) . '.xlsx';
        $file->move(storage_path() . '/xlsx', $filename);

        return $filename;
    }

    /**
     * Process file on queue
     * Obtains lines of .xslx file, checks presence of products line
     * and calls createOrUpdateProducts method
     * @param string $filename
     * @return bool
     */
    public function processFileWithProducts($filename)
    {
        $rowsTable = $this->obtainRowsOfFileWithProducts($filename);

        if ($rowsTable) {
            foreach ($rowsTable as $rowTable) {
                $this->createOrUpdateProduct($rowTable);
            }

            return true;
        }

        return false;
    }

    /**
     * Extract data of .xlsx file
     * Obtain rows with data about the products on the .xlsx file
     * @param string $filename
     * @return mixed
     */
    private function obtainRowsOfFileWithProducts($filename)
    {
        try {
            $rows = Excel::selectSheetsByIndex(0)
                ->load(storage_path() . '/xlsx/' . $filename)
                ->get()
                ->toArray();

            return $rows;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return false;
        }
    }

    /**
     * Makes creation or updates a product
     * Calls updateOrCreateProduct method on ProductRepository class,
     * this method can be used for manipulation before final recording
     * @param array $product
     */
    private function createOrUpdateProduct($product)
    {
        $this->productRepository->updateOrCreateProduct($product);
    }
}