<?php

namespace App\Http\Livewire\Shop\Cart;

use App\Services\PaymentBase;
use App\Services\PaymentFactory;
use App\Services\PlaceToPayPayment;
use App\Models\Product;
use App\Models\Order;
use App\ViewModels\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\DatePaymentRequest;

class PaymentComponent extends Component
{
    public $total;
    public function render(): View
    {
        $cart_items = \Cart::getContent();

        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $item->product = $product;
        }
        $this->refreshTotal(); // Actualizar el valor total


        $paymentModel = new PaymentModel($cart_items);
        $paymentProcessors = $paymentModel->paymentProcessors();
        $orders = Order::with('product')->get();

        return view('livewire.shop.cart.index-component', compact('cart_items', 'paymentProcessors'))
            ->extends('template.admin')
            ->section('content');
    }


    public function refreshTotal(): float
    {
        $cart_items = \Cart::getContent();
        $this->total = $cart_items->sum(function ($item) {
            $product = Product::find($item->id);
            return $product->price * $item->quantity;
        });
        return $this->total;

    }

    public function update_quantity($itemId, $quantity): void
    {
        \Cart::update($itemId, [
            'quantity' => [
                'relative' => false,
                'value' => $quantity,
            ],
        ]);

        $this->refreshTotal();

    }

    public function delete_item($itemId)
    {
        \Cart::remove($itemId);
    }

    public function processPayment(DatePaymentRequest $request, PaymentFactory $paymentFactory): RedirectResponse
    {
        $processor = $paymentFactory->initializePayment($request->get('payment_type'));
        return $processor->pay($request);
        /*$this->sendEmail($processor);
        return view('payments.success', [
            'processor' => $request->get('payment_type'),
            'status' => 'COMPLETED'
        ]);*/
    }

    private function sendEmail(PaymentBase $base): void
    {
        $base->sendNotification();
    }

    public function processResponse(PlaceToPayPayment $placeToPayPayment): View
    {
        return $placeToPayPayment->getRequestInformation();
    }
}
