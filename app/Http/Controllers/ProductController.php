<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Cache;


class ProductController extends controller
{
    public function index(Request $request): View
    {
        $roles = Role::all();
        $categories = Category::all();
        $texto = trim($request->get('texto'));

        $tiempoEnMinutos = 20;
        $products = Cache::remember('productos_' . $texto, $tiempoEnMinutos, function () use ($texto) {
            return DB::table('products')
                ->select('id', 'name', 'description', 'price', 'quantity', 'category_id', 'status', 'cover_img')
                ->where('name', 'LIKE', '%' . $texto . '%')
                ->orWhere('description', 'LIKE', '%' . $texto . '%')
                ->orderBy('id', 'asc')
                ->paginate(10);
        });

        return view('product.index', compact('products', 'categories', 'texto'));
    }

    public function downloadExport($fileName): StreamedResponse
    {
        $filePath = 'exports/' . $fileName;

        if (Storage::disk('public')->exists($filePath)) {
            // Marcar el archivo como descargado
            Session::put('exported_file_downloaded', true);

            return Storage::disk('public')->download($filePath);
        }

        abort(404);
    }

    public function create(): View
    {
        //
        $categories = Category::all(); // Obtener todas las categorías disponibles
        $product = Product::all();
        return view('product.store_product', compact('product', 'categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $categories = Category::all();
        $product = new Product($request->input());
        $product->save();
        return redirect('product', compact('product', 'categories'));
    }

    public function show($id): View
    {
        //
        $product = Product::find($id);
        return view('product.index', compact('product'));
    }

    public function edit($id): View
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('product.edit_product', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id): RedirectResponse
    {
        $product = Product::find($id);
        $categories = Category::all();
        $product->fill($request->input())->saveOrFail();
        return redirect('product');
    }
    public function destroy($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'El producto se ha sido eliminado exitosamente.');
    }
}
