<div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mx-auto">
    <div class="flex flex-col mt-3">
        <div class="mx-auto">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Carrito De Compras') }}</h2>
            </div>
        </div>

        <form action="{{ route('payments.processPayment') }}" method="post" class="w-full py-1">
                @csrf
                <div class="flex flex-col md:flex-row justify-center py-10 min-h-screen">
                    @auth()
                        <div class="py-4">
                            <form  class="bg-white shadow-md rounded px-8 pt-6 pb-8 py-4" >
                                @csrf
                                <div class="mx-auto">
                                    <div class="flex items-center justify-center mb-1">
                                        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight">{{ __('Información del comprador') }}</h2>
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="documentType" :value="__('Tipo de documento')" />
                                    <select name="documentType" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-96">
                                        <option value="CC" @if(auth()->user()->documentType == 'CC') selected @endif>CC</option>
                                        <option value="CE" @if(auth()->user()->documentType == 'CE') selected @endif>CE</option>
                                        <option value="TI" @if(auth()->user()->documentType == 'TI') selected @endif>TI</option>
                                        <option value="NIT" @if(auth()->user()->documentType == 'NIT') selected @endif>NIT</option>
                                        <option value="RUT" @if(auth()->user()->documentType == 'RUT') selected @endif>RUT</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('documentType')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="document" :value="__('Documento de identidad')" />
                                    <x-text-input id="document" class="block mt-1 w-96" type="text" name="document" :value="auth()->user()->document" autofocus autocomplete="document" placeholder="Documento"/>
                                    <x-input-error :messages="$errors->get('document')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="name" :value="__('Nombre')" />
                                    <x-text-input id="name" class="block mt-1 w-96" type="text" name="name" :value="auth()->user()->name"  autofocus autocomplete="name" placeholder="Nombre"/>
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="surname" :value="__('Apellido')" />
                                    <x-text-input id="surname" class="block mt-1 w-96" type="text" name="surname" :value="auth()->user()->surname"  autofocus autocomplete="surname" placeholder="Apellido"/>
                                    <x-input-error :messages="$errors->get('surname')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Correo Eléctronico')" />
                                    <x-text-input id="email" class="block mt-1 w-96" type="text" name="email" :value="auth()->user()->email" autofocus autocomplete="email" placeholder="Correo"/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="mobile" :value="__('Número de teléfono')" />
                                    <x-text-input id="mobile" class="block mt-1 w-96" type="text" name="mobile" :value="auth()->user()->mobile" autofocus autocomplete="mobile" placeholder="Teléfono"/>
                                    <x-input-error :messages="$errors->get('mobile')" class="mt-1" />
                                </div>
                            </form>
                        </div>
                    @endauth

                    <div class="w-full md:w-3/4 md:px-6">
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                            <div class="mx-auto">
                                <div class="flex items-center justify-center mb-1">
                                    <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight">{{ __('Mi Carrito') }}</h2>
                                </div>
                            </div>
                            <table class="w-full divide-y divide-orange-500">
                              <thead class="bg-orange-400-50">
                                <tr>
                                  <th scope="col" class="px-4 py-2 text-sm font-bold text-center text-orange-600"><strong>{{ __('Nombre') }}</strong></th>
                                  <th scope="col" class="px-4py-2 text-sm font-bold text-center text-orange-600"><strong>{{ __('Cantidad') }}</strong></th>
                                  <th scope="col" class="px-4 py-2 text-sm font-bold text-center text-orange-600 w-1/6"><strong>{{ __('Precio') }}</strong></th>
                                  <th scope="col" class="px-4 py-2 text-sm font-bold text-center text-orange-600"><strong class="text-center">{{ __('Acciones') }}</strong></th>
                                </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cart_items->sortBy('id') as $key => $item)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-center text-gray-900">{{ $item->product->name }}</td>
                                        <td class="px-2 py-2 text-sm text-center text-gray-900">
                                            <input type="number" wire:change="update_quantity({{ $item->id }}, $event.target.value)" class="px-3 py-2 rounded-lg border whitespace-nowrap" value="{{ $item->quantity }}" min="0">
                                        </td>
                                        <td class="px-2 py-2 text-sm text-center text-gray-900 whitespace-nowrap">COP {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                        <td class="px-1 py-1 text-sm font-medium text-center">
                                            <button type="button" wire:click="delete_item({{ $item->id }})" class="px-4 py-2 rounded-lg bg-red-500 text-white">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                              </tbody>
                            </table>

                        </form>
                    </div>

                     <h3 class="px-2 py-1 text-xl font-bold text-black uppercase text-right">
                        Total: COP {{ number_format($total, 0, ',', '.') }}
                     </h3>


                    <div class="px-2 py-1 text-xl font-bold text-black uppercase text-right">
                        @if ($total > 0)
                            @auth
                                @if(auth()->user()->email_verified_at)
                                    <div class="mt-1">

                                        <div class="px-2 text-xl font-bold text-black text-right">
                                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Medio de Pago</label>
                                            <div class="flex flex-col items-end">
                                                <select name="payment_type" class="px-4 py-2 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-35 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    @foreach($paymentProcessors as $processor)
                                                        <option value="{{ $processor }}" {{ $processor == 'PlaceToPay' ? 'selected' : '' }}>{{ $processor }}</option>
                                                    @endforeach
                                                </select>
                                                <img src="https://static.placetopay.com/placetopay-logo-black.svg" class="w-24 mt-2 py-1" alt="150">
                                            </div>
                                        </div>

                                        <button type="submit" class="px-4 py-1 border border-transparent rounded-r-md bg-orange-500 hover:bg-orange-600 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                            <i class="fa-solid fa-floppy-disk"></i> Pagar
                                        </button>
                                    </div>
                                @else
                                    <span class="px-4 py-2 rounded-r-md bg-transparent text-gray-800">
                                        Por favor, verifique su correo para proceder con el Pago.
                                        <a href="{{ route('verification.notice') }}" class="ml-2 text-orange-500 hover:text-orange-500">Verificar correo</a>
                                    </span>
                                @endif
                            @else
                                <span class="px-4 py-2 rounded-r-md bg-transparent text-gray-800">
                                    Por favor, inicie sesión para proceder con el Pago.
                                </span>
                            @endauth
                        @else
                            <span class="px-4 py-2 rounded-r-md bg-transparent text-gray-800">
                                Por favor, agregue al menos un producto al carrito para poder pagar.
                            </span>
                        @endif
                    </div>
                </div>
        </form>
    </div>
</div>


