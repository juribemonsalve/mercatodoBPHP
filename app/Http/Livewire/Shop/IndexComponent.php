<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexComponent extends Component
{
    public function render(Request $request)
    {
        $texto = trim($request->get('texto'));

        $products = DB::table('products')
            ->select('name', 'description', 'price')
            ->where('name', 'LIKE', '%' . $texto . '%')
            ->orWhere('description', 'LIKE', '%' . $texto . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        $products = Product::where('status', 'active')->get();
        return view('livewire.shop.index-component', compact('products', 'texto'))
            ->extends('template.admin')
            ->section('content');
    }
}
