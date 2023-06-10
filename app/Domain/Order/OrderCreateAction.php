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
        return Order::query()->create([
            'user_id' => auth()->id(),
            'provider' => $data['payment_type'],
            'total' => $total,
        ]);

    }
}
