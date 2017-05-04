<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\ProcessFileXSLX;
use App\Models\Repositories\ProductRepository;
use App\Models\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * Gets index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $productsData = $productRepository->getProducts();

        return view('index', ['productsData' => $productsData, 'result' => 'no_show']);
    }

    /**
     * Receives .xlsx file
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadFile(Request $request)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $productsData = $productRepository->getProducts();

        if ($request->hasFile('file'))
        {
            $file = $request->file('file');

            /** @var ProductService $productService */
            $productService = App::make('ProductServiceInterface');

            $filename = $productService->storageFileUploaded($file);

            $this->dispatch(new ProcessFileXSLX($filename));

            return view('index', ['productsData' => $productsData, 'result' => true]);
        } else {
            return view('index', ['productsData' => $productsData, 'result' => 'error']);
        }
    }

    /**
     * Shows product edit page
     * @param int $lm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($lm)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');
        $productData = $productRepository->getProductsByLm($lm);

        return view('edit', ['productData' => $productData]);
    }

    /**
     * Update product
     * Updates a single product through form data
     * @param ProductRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(ProductRequest $request)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $productRepository->updateOrCreateProduct($request->all());

        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $productsData = $productRepository->getProducts();

        return view('index', ['productsData' => $productsData, 'result' => 'prod_edited']);
    }

    /**
     * Excludes a product by lm attribute
     * @param int $lm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($lm)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $result = $productRepository->delete($lm);

        $result = $result == false ? 'deleted_failed' : 'product_deleted';

        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $productsData = $productRepository->getProducts();

        return view('index', ['productsData' => $productsData, 'result' => $result]);
    }
}
