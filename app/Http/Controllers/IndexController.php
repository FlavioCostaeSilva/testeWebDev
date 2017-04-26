<?php

namespace App\Http\Controllers;

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
        $registros = Registro::all();

        return view('index', ['registros' => $registros]);
    }

    /**
     * @param Request $request
     */
    public function uploadfile(Request $request)
    {
        if ($request->hasFile('file'))
        {
            $file = $request->file('file');

            /** @var ProductService $productService */
            $productService = App::make('ProductServiceInterface');

            $productService->storageAndPreProcessFileUploaded($file);
        } else {

        }


//        return view('index', ['registros' => $registros,
//            'valor_bruto' => $valor_bruto,
//            'aviso_adicao' => $aviso_adicao]);
    }
}
