<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessFileXSLX;
use App\Models\Repositories\ProductRepository;
use App\Models\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
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

        return view('index', ['registros' => $registros, 'aviso_adicao' => 'no_show']);
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

            return view('index', ['registros' => $registros,
            'aviso_adicao' => true]);
        } else {
            return view('index', ['registros' => $registros, 'aviso_adicao' => 'error']);
        }
    }
}
