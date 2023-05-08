<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        //
        $roles = Role::all();
        $products = Product::all();
        $texto = trim($request->get('texto'));

        $categories = DB::table('categories')
            ->select('id', 'name', 'description')
            ->where('name', 'LIKE', '%' . $texto . '%')
            ->orWhere('description', 'LIKE', '%' . $texto . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('category.index', compact('categories', 'texto'));
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
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

    public function update(CategoryRequest $request, $id)
    {
        //
        $category = Categories::find($id);
        $category->fill($request->input())->saveOrFail();
        return redirect('category');
    }

    public function destroy($id)
    {
        try {
            $products = Product::where('category_id', $id)->exists();
            $category = Categories::findOrFail($id);

            if ($products) {
                return redirect()->back()->withErrors(['error' => 'No es posible eliminar la categoría porque existen productos asociados.']);
            } else {
                $category->delete();
                return redirect()->back()->with('success', 'La categoría ha sido eliminada exitosamente.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'No se encontró la categoría.']);
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Se produjo un error al eliminar la categoría.']);
        }
    }
}
