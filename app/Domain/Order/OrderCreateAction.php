<?php

namespace App\Domain\Order;

use App\Http\Livewire\Shop\Cart\paymentComponent;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class OrderCreateAction extends Component
{
    public static function execute(array $data): Model
    {
        $paymentComponent = new paymentComponent();
        $total = $paymentComponent->refreshTotal();
        $item_count = \Cart::getContent()->count();
        $cartItems = \Cart::getContent();

        $order = Order::create([
            'user_id' => auth()->id(),
            'provider' => $data['payment_type'],
            'total' =>  $total,
            'item_count' => $item_count,
            'currency' => 'COP',
        ]);

        $order->reference_order = 'ORDEN-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);
        $order->save();

        foreach ($cartItems as $key => $item) {
            $order->orderItems()->create([
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ]);
        }

        return $order;
    }
}
