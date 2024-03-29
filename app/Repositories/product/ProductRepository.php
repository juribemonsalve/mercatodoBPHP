<?php

namespace App\Repositories\product;

use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    public function productsImport(Request $request): array
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
