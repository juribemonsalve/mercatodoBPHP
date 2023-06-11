@extends('template.admin')
    @section('content')



                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

                    <div class="flex flex-col mt-6">
                        <div class="mx-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Mis Ordenes') }}</h2>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">
                                <div class="table-responsive">
                                    <table class="w-full divide-y divide-orange-500">
                                        <thead class="bg-orange-400-50">
                                            <tr>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/8"><strong>{{ __('Referencia') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/8"><strong>{{ __('Metodo de pago') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/8"><strong>{{ __('Total') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong>{{ __('Moneda') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong>{{ __('Estado') }}</strong></th>

                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">


                                            @php
                                                $user_id = auth()->id(); // Get the authenticated user's ID
                                            @endphp

                                             @foreach ($orders as $order)
                                                 @if ($order->user_id === $user_id)
                                                    <tr>
                                                      <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $order->reference_order }}</td>
                                                      <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $order->provider }}</td>
                                                      <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ number_format($order->total, 0, ',', '.') }}</td>
                                                      <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $order->currency }}</td>
                                                      <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $order->status }}</td>


                                                        @if (!in_array($order->status, ['APPROVED', 'REJECTED']))
                                                          <td class="px-1 py-1 text-sm font-medium text-center">
                                                            <a href="{{ $order->process_url }}" class="text-blue-400 hover:text-orange-500 font-extrabold">
                                                              <i class="fas fa-sync-alt"></i> Reintentar Pago
                                                            </a>
                                                          </td>
                                                        @endif
                                                    </tr>
                                                 @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    @endsection

