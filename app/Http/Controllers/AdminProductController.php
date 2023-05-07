<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        //
        $roles = Role::all();
        $categories = Categories::all();
        $texto = trim($request->get('texto'));

        $products = DB::table('products')
            ->select('id', 'name', 'description', 'price', 'quantity', 'category_id', 'status', 'cover_img', )
            ->where('name', 'LIKE', '%' . $texto . '%')
            ->orWhere('description', 'LIKE', '%' . $texto . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('adminproduct.index', compact('products', 'categories', 'texto'));
    }

    public function create()
    {
        //
        $categories = Categories::all(); // Obtener todas las categorías disponibles
        return view('product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'status' => 'required|in:active,disabled',
        ], [
            'name.required' => 'El campo Nombre es obligatorio.',
            'description.required' => 'El campo Descripción es obligatorio.',
            'price.required' => 'El campo Precio es obligatorio.',
            'quantity.required' => 'El campo Cantidad es obligatorio.',
            'category_id.required' => 'El campo Categoría Producto es obligatorio.',
            'status.required' => 'El campo Estado Producto es obligatorio.',
            'status.in' => 'El campo Estado Producto debe ser "active" o "disabled".',
        ]);

        $product = new Product($request->input());
        $product->saveOrFail();

        return redirect(route('adminproduct.index'));
    }

    public function show($id)
    {
        //
        $product = Product::find($id);
        return view('adminproduct.index', compact('product'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'status' => 'required|in:active,disabled',
        ], [
            'name.required' => 'El campo Nombre es obligatorio.',
            'description.required' => 'El campo Descripción es obligatorio.',
            'price.required' => 'El campo Precio es obligatorio.',
            'quantity.required' => 'El campo Cantidad es obligatorio.',
            'category_id.required' => 'El campo Categoría Producto es obligatorio.',
            'status.required' => 'El campo Estado Producto es obligatorio.',
            'status.in' => 'El campo Estado Producto debe ser "active" o "disabled".',
        ]);

        $product = Product::find($id);
        $categories = Categories::all();
        $product->fill($request->input())->saveOrFail();
        return redirect(route('adminproduct.index'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'El producto se ha sido eliminado exitosamente.');
    }
}
