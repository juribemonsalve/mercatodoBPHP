<?php

namespace App\Services;

use App\Domain\Order\OrderCreateAction;
use App\Domain\Order\OrderGetLastAction;
use App\Domain\Order\OrderUpdateAction;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\DatePaymentRequest;


class PlaceToPayPayment extends PaymentBase
{
    public function pay(Request $request): RedirectResponse
    {
        Log::info('[PAY]: Pago con PlaceToPay');

        $order = OrderCreateAction::execute($request->all());

        $result = Http::post(
            config('placetopay.url') . '/api/session',
            $this->createSession($order, $request, $request->ip(), $request->userAgent())
        );

        if ($result->ok()) {
            $order->request_id = $result->json()['requestId'];
            $order->process_url = $result->json()['processUrl'];

            OrderUpdateAction::execute($order);
            return redirect()->to($order->process_url)->send();
        }

        throw new \Exception($result->body());
    }

    public function sendNotification()
    {
        Log::info('[PAY]: Enviamos la notificacion PlaceToPay');
    }

    private function createSession(Model $order, string $ipAddress, string $userAgent): array
    {


        return [
            'auth' => $this->getAuth(),
            'buyer' => [
                'document' => $request->input('document'),
                'documentType' => $request->input('documentType'),
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
            ],
            'payment' => [
                'reference' => 'reference_' . $order->reference_order,
                'description' => 'description_' . $order->reference_order,
                'amount' => [
                    'currency' => $order->currency,
                    'total' => $order->total,
                ],
            ],
            'expiration' => Carbon::now()->addHour(),
            'returnUrl' => route('payments.processResponse'),
            'ipAddress' => $ipAddress,
            'userAgent' => $userAgent,
        ];
    }

    private function getAuth(): array
    {
        $nonce = Str::random();
        $seed = date('c');

        return [
            'login' => config('placetopay.login'),
            'tranKey' => base64_encode(
                hash(
                    'sha256',
                    $nonce . $seed . config('placetopay.tranKey'),
                    true
                )
            ),
            'nonce' => base64_encode($nonce),
            'seed' => $seed,
        ];
    }

    public function getRequestInformation(): View
    {
        $order = OrderGetLastAction::execute();

        $result = Http::post(
            config('placetopay.url') . "/api/session/$order->request_id",
            [
                'auth' => $this->getAuth(),
            ]
        );
        if ($result->ok()) {
            $status = $result->json()['status']['status'];
            $order->status = $status; // Asignar el valor de cadena correctamente

            if ($status == 'APPROVED') {
                $order->completed();
            } elseif ($status == 'REJECTED') {
                $order->canceled();
            } elseif ($status == 'PENDING') {
                $order->pending();
            }

            OrderUpdateAction::execute($order);

            return view('payments.success', [
                'processor' => $order->provider,
                'status' => $order->status,
            ]);
        }

        throw  new \Exception($result->body());
    }
}
