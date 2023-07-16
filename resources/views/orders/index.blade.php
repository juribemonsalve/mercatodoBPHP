@extends('template.admin')
    @section('content')



                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

                    <div class="flex flex-col mt-6">
                        <div class="mx-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Mis Ordenes') }}</h2>
                        </div>
                    </div>




                    @can('order.report')
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="card-header">{{ __('Generar Reporte PDF') }}</div>


                            <div class="card-body">
                                <form action="{{ route('orders.report') }}" method="GET">
                                    @csrf

                                    <div class="flex items-center mb-4">
                                        <div class="mr-4">
                                            <label for="start_date" class="block font-medium text-sm text-gray-700">{{ __('Fecha de inicio') }}</label>
                                            <input type="date" name="start_date" id="start_date" class="bg-gray-200 rounded-lg p-2" required>
                                        </div>

                                        <div class="mr-4">
                                            <label for="end_date" class="block font-medium text-sm text-gray-700">{{ __('Fecha de fin') }}</label>
                                            <input type="date" name="end_date" id="end_date" class="bg-gray-200 rounded-lg p-2" required>
                                        </div>

                                        <button type="submit" class="bg-orange-600 hover:bg-orange-400 text-white font-bold py-2 px-2 rounded">
                                            <i class="fas fa-file-pdf"></i> {{ __('Generar PDF') }}
                                        </button>
                                    </div>
                                </form>

                                @php
                                    $exportedFile = Session::get('pdf_exported_file');
                                    $exportedFileDownloaded = Session::get('pdf_exported_file_downloaded');
                                @endphp

                                @if ($exportedFile && !$exportedFileDownloaded)
                                    <form action="{{ route('orders.downloadExport', ['fileName' => $exportedFile]) }}" method="get" class="px-2">
                                        @csrf
                                        <button class="flex items-center px-1 py-2 text-white bg-orange-400 rounded-md shadow-md hover:bg-orange-600" type="submit">
                                            <span class="mr-2 fa-solid fa-download"></span>
                                            Descargar último Reporte
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    @endcan



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

