<div class="flex items-center justify-center">
    <img width="200"
         src="https://cdn-icons-png.flaticon.com/512/3756/3756719.png"
         alt="Pago Expirado">
</div>

<div class="flex items-center justify-center">
    <h1>Pago Expirado !</h1>
</div>

<div class="flex items-center justify-center">
    <h4>Su pago fue expirado con {{ $processor }}</h4>
</div>

<div class="my-4 flex items-center justify-center">
    <x-button-component :label="'Ver mis Ordenes'" route="{{ route('orders.index') }}"/>
</div>
