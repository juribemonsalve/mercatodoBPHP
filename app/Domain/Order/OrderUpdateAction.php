<?php

namespace App\Domain\Order;

use Illuminate\Database\Eloquent\Model;

class OrderUpdateAction
{
    public static function execute(Model $order): void
    {
        $order->save();
    }
}
