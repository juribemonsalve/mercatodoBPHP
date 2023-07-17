<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request): LengthAwarePaginator
    {
        $products = Product::paginate(10);
        return $products;
    }

    public function show($id): Product
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function store(ProductRequest $request): Product
    {
        $product = new Product($request->all());
        $product->save();
        return $product;
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json([
            'message' => 'El producto se ha actualizado',
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado correctamente',
        ]);
    }
}
