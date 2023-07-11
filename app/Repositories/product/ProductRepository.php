<?php

namespace App\Repositories\product;
use App\Exports\ProductsExport;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Carbon\Carbon;


class ProductRepository
{
    public function productsExport(): BinaryFileResponse
    {
        $now = Carbon::now('America/Bogota');
        $fileName = 'products_' . $now->format('Ymd_His') . '.xlsx';

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has exported a list of products');
        return (new ProductsExport())->download($fileName);
    }

}
