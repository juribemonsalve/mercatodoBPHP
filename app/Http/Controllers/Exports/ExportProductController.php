<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\product\ProductRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }



    public function export()
    {
        // $this->authorize('products.export');  (Comentario: Si tienes autorización habilitada, descomenta esta línea)

        $filePath = $this->productRepo->productsExport();

        $fullPath = storage_path('app/public/' . $filePath);

        return response()->download($fullPath)->deleteFileAfterSend(true);
    }

    public function download($filePath)
    {
        $fullPath = Storage::disk('public')->path($filePath);

        return response()->download($fullPath);
    }
}
