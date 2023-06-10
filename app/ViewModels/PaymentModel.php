<?php

namespace App\ViewModels;

use App\Models\Product;
use Darryldecode\Cart\CartCollection;
use Illuminate\Database\Eloquent\Model;
use Spatie\ViewModels\ViewModel;

class PaymentModel extends ViewModel
{
    public function __construct(public CartCollection $cart_items)
    {
        //
    }

    public function product(): Model
    {
        return Product::query()->find($this->product_id);
    }

    public function paymentProcessors(): array
    {
        return [
            'PlaceToPay',
            'PayPal',
        ];
    }
}
