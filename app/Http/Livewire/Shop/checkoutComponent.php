<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class checkoutComponent extends Component
{
    public $document;
    public $documentType;
    public $name;
    public $surname;
    public $email;
    public $mobile;
    public $address;
    public $billing_document;
    public $billing_documentType;
    public $billing_name;
    public $billing_surname;
    public $billing_email;
    public $billing_mobile;
    public $billing_address;
    public $payment_method;
    public $total;

    public function render()
    {
        return view('livewire.shop.checkout-componet')
            ->extends('template.admin')
            ->section('content');
    }

    public function make_order()
    {
        $validatedData = $this->validate([
           'document' => 'required|integer',
           'documentType' => 'required|in:CC,CE,TI,NIT,RUT',
           'name' => 'required|regex:/^[a-zA-Z\s]+$/',
           'surname' => 'required|regex:/^[a-zA-Z\s]+$/',
           'email' => 'required|email',
           'mobile' => 'required|integer',
           'address' => 'required|max:30|regex:/^[a-zA-Z0-9\s\-#]+$/',
           'payment_method' => 'required',
        ], [
           'document.required' => 'El campo Documento de identidad es obligatorio.',
           'document.integer' => 'El campo Documento de identidad debe ser un número entero.',
           'document.min' => 'El campo Documento de identidad debe tener al menos :min caracteres.',
           'documentType.required' => 'El campo Tipo de documento es obligatorio.',
           'documentType.in' => 'El campo Tipo de documento debe ser uno de los siguientes valores: CC, CE, TI, NIT, RUT.',
           'name.required' => 'El campo Nombre es obligatorio.',
           'name.alpha' => 'El campo Nombre solo puede contener letras.',
           'surname.required' => 'El campo Apellido es obligatorio.',
           'surname.alpha' => 'El campo Apellido solo puede contener letras.',
           'email.required' => 'El campo Correo Electrónico es obligatorio.',
           'email.email' => 'El campo Correo Electrónico debe ser una dirección de correo válida.',
           'mobile.required' => 'El campo Número de teléfono es obligatorio.',
           'mobile.integer' => 'El campo Número de teléfono debe ser un número entero.',
           'address.required' => 'El campo Información de dirección es obligatorio.',
           'address.max' => 'El campo Información de dirección no puede exceder los :max caracteres.',
           'address.regex' => 'El campo Información de dirección solo puede contener letras y espacios.',
           'payment_method.required' => 'El campo Medio de Pago es obligatorio.',
        ]);

        $order = new  Order();
        $order->user_id = auth()->id();
        $order->order_number = uniqid('OrderNumber-');
        $order->item_count = \Cart::session(auth()->id())->getContent()->count();

        $order->shipping_document = $this->document;
        $order->shipping_documentType = $this->documentType;
        $order->shipping_name = $this->name;
        $order->shipping_surname = $this->surname;
        $order->shipping_email = $this->email;
        $order->shipping_mobile = $this->mobile;
        $order->shipping_address = $this->address;
        if (is_null($this->billing_document)) {
            $order->billing_document = $this->document;
            $order->billing_documentType = $this->documentType;
            $order->billing_name = $this->name;
            $order->billing_surname = $this->surname;
            $order->billing_email = $this->email;
            $order->billing_mobile = $this->mobile;
            $order->billing_address = $this->address;
        } else {
            $order->billing_document = $this->billing_document;
            $order->billing_documentType = $this->billing_documentType;
            $order->billing_name = $this->billing_name;
            $order->billing_surname = $this->billing_surname;
            $order->billing_email = $this->billing_email;
            $order->billing_mobile = $this->billing_mobile;
            $order->billing_address = $this->billing_address;
        }
        $order->payment_method = $this->payment_method;
        $order->total = \Cart::session(auth()->id())->getTotal();
        //$order->is_paid

        //$order->is_paid
        if ($this->payment_method == 'placetopay') {
        } else {
            //false
        }
    }
}
