<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\product\ProductRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Jobs\ExportProductsJob;

class ExportProductController extends Controller
{

    public function export(): RedirectResponse
    {
        // $this->authorize('products.export');  (Comentario: Si tienes autorización habilitada, descomenta esta línea)

        ExportProductsJob::dispatch();

        return redirect()->back()->with('success', 'Exportación enviada.');
    }


    public function download($filePath): BinaryFileResponse
    {
        $fullPath = Storage::disk('public')->path($filePath);

        return response()->download($fullPath);
    }
}
