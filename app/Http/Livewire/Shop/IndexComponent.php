<?php


namespace App\Http\Livewire\Shop;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexComponent extends Component
{
    public function render(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->latest('id', 'asc')
                    ->paginate(10);
        $data = [
            'products' => $products,
            'search' => $search,
        ];

        return view('livewire.shop.index-component', $data)
            ->extends('template.admin')
            ->section('content');
    }


}
