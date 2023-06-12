<?php

namespace App\Services;

use App\Contracts\PaymentFactoryInterface;
use Exception;

class PaymentFactory implements PaymentFactoryInterface
{
    public function initializePayment(string $type): PaymentBase
    {
        if ($type == 'PlaceToPay') {
            return new PlaceToPayPayment();
        } elseif ($type == 'PayPal') {
            throw new Exception('Medio de pago no soportado');
        }

        throw new Exception('Medio de pago no soportado');
    }
}
