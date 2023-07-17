<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Contracts\Cache\Repository;

class IndexComponent extends Component
{
    public function render(Request $request): View
    {
        $search = $request->input('search');
        $products = Product::where('status', 'active')
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->latest('id')
            ->paginate(9);

        $data = [
            'products' => $products,
            'search' => $search,
        ];
        return view('livewire.shop.index-component', $data)
            ->extends('template.admin')
            ->section('content');
    }

    public function add_to_cart(Product $product)
    {
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [],
            'associatedModel' => $product,

        ]);

        $this->emit('message', 'El producto se ha agregado correctamente.');
        $this->emitTo('shop.cart-component', 'add_to_cart');
    }
}
