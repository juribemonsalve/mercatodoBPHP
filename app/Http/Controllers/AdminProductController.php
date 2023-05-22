<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminProductRequest;
use App\Models\Category;
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
        $categories = Category::all();
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
        $categories = Category::all(); // Obtener todas las categorías disponibles
        return view('product', compact('categories'));
    }

    public function store(AdminProductRequest $request)
    {
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

    public function update(AdminProductRequest $request, $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
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
