<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\ProcessFileXSLX;
use App\Models\Repositories\ProductRepository;
use App\Models\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $registros = $productRepository->getProducts();

        return view('index', ['registros' => $registros, 'result' => 'no_show']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadfile(Request $request)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $registros = $productRepository->getProducts();

        if ($request->hasFile('file'))
        {
            $file = $request->file('file');

            /** @var ProductService $productService */
            $productService = App::make('ProductServiceInterface');

            $filename = $productService->storageFileUploaded($file);

            $this->dispatch(new ProcessFileXSLX($filename));

            return view('index', ['registros' => $registros, 'result' => true]);
        } else {
            return view('index', ['registros' => $registros, 'result' => 'error']);
        }
    }

    /**
     * @param $lm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($lm)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = App::make('ProductRepositoryInterface');

        $registro = $productRepository->getProductsByLm($lm);

        return view('edit', ['registro' => $registro]);
    }

    /**
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

        $registros = $productRepository->getProducts();

        return view('index', ['registros' => $registros, 'result' => 'prod_edited']);
    }

    /**
     * @param $lm
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

        $registros = $productRepository->getProducts();

        return view('index', ['registros' => $registros, 'result' => $result]);
    }
}
