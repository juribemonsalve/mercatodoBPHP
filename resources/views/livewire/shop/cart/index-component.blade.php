<div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mx-auto">
    <div class="flex flex-col mt-6">
        <div class="mx-auto">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Carrito De Compras') }}</h2>
            </div>
        </div>

        <div class="container-fluid">
            <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">
                    <div class="table-responsive">
                        <table class="w-full divide-y divide-orange-500">
                            <thead class="bg-orange-400-50">
                                <tr>
                                    <th scope="col" class="px-2 py-2 text-sm font-bold text-center text-orange-600"><strong>{{ __('Nombre') }}</strong></th>
                                    <th scope="col" class="px-2 py-2 text-sm font-bold text-center text-orange-600"><strong>{{ __('Cantidad') }}</strong></th>
                                    <th scope="col" class="px-2 py-2 text-sm font-bold text-center text-orange-600 w-1/6"><strong>{{ __('Precio') }}</strong></th>
                                    <th scope="col" class="px-2 py-2 text-sm font-bold text-center text-orange-600"><strong class="text-center">{{ __('Acciones') }}</strong></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cart_items->sortBy('id') as $key => $item)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-center text-gray-900">{{ $item->name }}</td>
                                        <td class="px-2 py-2 text-sm text-center text-gray-900">
                                            <input type="number" wire:change="update_quantity({{ $item->id }}, $event.target.value)" class="px-3 py-2 rounded-lg border whitespace-nowrap" value="{{ $item->quantity }}">
                                        </td>
                                        <td class="px-2 py-2 text-sm text-center text-gray-900 whitespace-nowrap">COP {{ number_format(\Cart::get($item->id)->getPriceSum(), 0, ',', '.') }}</td>
                                        <td class="px-1 py-1 text-sm font-medium text-center">
                                            <button type="button" wire:click="delete_item({{ $item->id }})" class="px-4 py-2 rounded-lg bg-red-500 text-white">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="flex justify-end">
                            <h3 class="px-2 py-2 text-xl font-bold text-black uppercase">
                                Total: COP {{ number_format(\Cart::getTotal(), 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="flex justify-end">
                            @if (\Cart::getTotal() > 0)
                                @auth
                                    @if(auth()->user()->email_verified_at)
                                        <a href="{{ route('checkout') }}" class="px-4 py-2 border border-transparent rounded-r-md bg-orange-500 hover:bg-orange-600 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                            Pagar
                                        </a>
                                    @else
                                        <span class="px-4 py-2 border border-transparent rounded-r-md bg-gray-300 text-gray-600">
                                            Por favor, verifique su correo para poder realizar el pago.
                                            <a href="{{ route('verification.notice') }}" class="ml-2 text-orange-500 hover:text-orange-500">Verificar correo</a>
                                        </span>
                                    @endif
                                @else
                                    <span class="px-4 py-2 border border-transparent rounded-r-md bg-gray-300 text-gray-600">
                                        Por favor, inicie sesión para realizar el pago.
                                    </span>
                                @endauth
                            @else
                                <span class="px-4 py-2 border border-transparent rounded-r-md bg-gray-300 text-gray-600">
                                    Por favor, agregue al menos un producto al carrito para poder pagar.
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


