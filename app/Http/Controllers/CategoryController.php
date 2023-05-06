<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function index()
    {
        //

        $roles = Role::all();
        $products = Products::all();
        $categories = Categories::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        ////
        ///
        $request->validate([
            'name'=>'required',
            'description'=>'required',

        ]);

        $category = new Categories($request->input());
        $category->save();
        return redirect('category');
    }

    public function show($id)
    {
        //
        $category = Categories::find($id);
        return view('category.editCategory', compact('category'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $category = Categories::find($id);
        $category->fill($request->input())->saveOrFail();
        return redirect('category');
    }

    public function destroy($id)
    {

        try {
            $category = Categories::findOrFail($id);

            if ($category->products()->exists()) {
                return redirect()->back()->withErrors(['error' => 'No es posible eliminar la categoría porque existen productos asociados.']);
            }

            $category->delete();

            return redirect()->back()->with('success', 'La categoría ha sido eliminada exitosamente.');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'No es posible eliminar la categoría porque existen productos asociados.']);
        }
    }
}
