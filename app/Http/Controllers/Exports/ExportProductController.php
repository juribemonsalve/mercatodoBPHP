<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\product\ProductRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function export(): BinaryFileResponse
    {
        // $this->authorize('products.export');  (Comentario: Si tienes autorización habilitada, descomenta esta línea)

        return $this->productRepo->productsExport();

        //return redirect()->route('admin.product.index')->with('success', 'The export is being generated');
    }
}
