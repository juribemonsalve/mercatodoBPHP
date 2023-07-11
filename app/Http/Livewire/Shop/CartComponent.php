<?php

namespace App\Http\Livewire\Shop;

use Illuminate\View\View;
use Livewire\Component;

class CartComponent extends Component
{
    public $cart;
    protected $listeners = ['add_to_cart'];
    public function add_to_cart()
    {
    }
    public function render(): View
    {
        return view('livewire.shop.cart-component');
    }
}
