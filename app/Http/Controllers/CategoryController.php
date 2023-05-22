<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
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
        $search = $request->search;

        $categories = Category::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);
        $data = ['categories' => $categories, 'search' => $search];
        return view('category.index', $data);
    }

    public function create()
    {
        //

        return view('category.store_category');
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category($request->input());
        $category->save();
        return redirect('category');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.update_category', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        //
        $category = Category::find($id);
        $category->fill($request->input())->saveOrFail();
        return redirect('category');
    }

    public function destroy($id)
    {
        try {
            $products = Product::where('category_id', $id)->exists();
            $category = Category::findOrFail($id);

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
