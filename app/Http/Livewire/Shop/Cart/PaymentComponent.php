<?php

namespace App\Http\Livewire\Shop\Cart;

use App\Services\PaymentBase;
use App\Services\PaymentFactory;
use App\Services\PlaceToPayPayment;

use App\ViewModels\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;

class paymentComponent extends Component
{
    public function render()
    {
        $cart_items = \Cart::getContent();
        $paymentModel = new PaymentModel($cart_items);
        $paymentProcessors = $paymentModel->paymentProcessors(); // Obtener el array de los procesadores de pago

        return view('livewire.shop.cart.index-component', compact('cart_items', 'paymentProcessors'))
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

    public function processPayment(Request $request, PaymentFactory $paymentFactory)
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

    public function processResponse(PlaceToPayPayment $placeToPayPayment)
    {
        return $placeToPayPayment->getRequestInformation();
    }
}
