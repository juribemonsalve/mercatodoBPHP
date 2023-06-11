<?php

namespace App\Domain\Order;

use App\Models\Order;

class OrderUpdateAction
{
    public static function execute(Order $order): void
    {
        $order->save();
    }
}
