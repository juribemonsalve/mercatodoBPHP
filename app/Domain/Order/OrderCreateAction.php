<?php

namespace App\Domain\Order;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class OrderCreateAction extends Component
{
    public static function execute(array $data): Model
    {
        $total = \Cart::getTotal();

        $order = Order::create([
            'user_id' => auth()->id(),
            'provider' => $data['payment_type'],
            'total' => $total,
            'currency' => 'COP',

        ]);

        $order->reference_order = 'ORDEN-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);
        $order->save();

        return $order;
    }
}
