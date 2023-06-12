<?php

namespace Tests\Feature;

use App\Services\PlaceToPayPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PlaceToPayPaymentTest extends TestCase
{
    use RefreshDatabase;
    protected function pay(): void
    {
        parent::pay();

        // Define las rutas necesarias para la prueba
        Route::post('/api/session', function (Request $request) {
            return Http::response([
                'requestId' => 1,
                'processUrl' => 'https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a',
            ], 200);
        })->name('payments.processPayment');
    }

    public function test_getAuth()
    {
        config([
            'placetopay.login' => env('PLACETOPAY_LOGIN'),
            'placetopay.tranKey' => env('PLACETOPAY_TRANKEY'),
            'placetopay.url' => env('PLACETOPAY_URL'),
        ]);

        $Service = new PlaceToPayPayment();
        $Data = $Service->getAuth();

        $nonce = base64_decode($Data['nonce']);
        $seed = $Data['seed'];
        $tranKey = base64_decode($Data['tranKey']);

        $expectedTranKey = hash('sha256', $nonce . $seed . env('PLACETOPAY_TRANKEY'), true);

        $this->assertEquals($expectedTranKey, $tranKey);
    }
}
