<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminProductController extends Controller
{
    public function index()
    {
        //

        $roles = Role::all();
        $products = Products::all();
        $categories = Categories::all();
        return view('adminproduct.index', compact('products', 'categories'));
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

        $product = new Products($request->input());
        $product->saveOrFail();

        return redirect(route('adminproduct.index'));
    }

    public function show($id)
    {
        //
        $product = Products::find($id);
        return view('adminproduct.index', compact('product'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $product = Products::find($id);
        $categories = Categories::all();
        $product->fill($request->input())->saveOrFail();
        return redirect(route('adminproduct.index'));
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'El producto se ha sido eliminado exitosamente.');
    }
}
