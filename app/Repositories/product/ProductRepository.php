<?php

namespace App\Repositories\product;
use App\Exports\ProductsExport;


use App\Imports\ProductsImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\UploadedFile;


class ProductRepository
{
    public function productsExport(): BinaryFileResponse
    {
        $now = Carbon::now('America/Bogota');
        $fileName = 'products_' . $now->format('Ymd_His') . '.xlsx';

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has exported a list of products');
        return (new ProductsExport())->download($fileName);
    }

    public function productsImport(Request $request): Array
    {
        $file = $request->file('document');
        $import = new ProductsImport();
        $failures = null;

        try {
            $import->import($file);
            Log::info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has imported a list of products');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            Log::info('Error al import', [$failures]);

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }

        if ($failures) {
            return ['success' => false, 'failures' => $failures];
        } else {
            return ['success' => true, 'failures' => null];
        }
    }
}
