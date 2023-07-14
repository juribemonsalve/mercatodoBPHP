<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileRequest;
use App\Repositories\product\ProductRepository;

class ImportProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function import(ImportFileRequest $request)
    {
        //$this->authorize('products.import');

        $response = $this->productRepo->productsImport($request);

        if ($response['success']) {
            return back()->with('message', '¡Importe realizado con éxito!');
        } else {
            return back()->withErrors($response['failures'])->withInput();
        }
    }
}
