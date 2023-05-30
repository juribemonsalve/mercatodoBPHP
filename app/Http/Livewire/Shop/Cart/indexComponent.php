<?php

namespace App\Http\Livewire\Shop\Cart;

use Livewire\Component;

class indexComponent extends Component
{
    public function render()
    {
        $cart_items = \Cart::getContent();
        return view('livewire.shop.cart.index-component', compact('cart_items'))
            ->extends('template.admin')
            ->section('content');
    }

    public function update_quantity($itemId, $quantity): void
    {
        \Cart::update($itemId, [
            'quantity' => [
                'relative' => false,
                'value' => $quantity,
            ],
        ]);
    }

    public function delete_item($itemId)
    {
        \Cart::remove($itemId);
    }
}
