<?php

namespace App\Domain\Order;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class OrderUpdateAction
{
    public static function execute(Order $order): void
    {
        $order->save();
    }
}
