@extends('template.admin')
    @section('content')

                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

                    <div class="flex flex-col mt-6">
                        <div class="mx-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Estado del Pago') }}</h2>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">

                                <div class="py-12">

                                                @if($status == 'APPROVED')
                                                    @include('payments.partial.status_approved')
                                                @endif

                                                @if($status == 'PENDING')
                                                    @include('payments.partial.status_pending')
                                                @endif

                                                @if($status == 'REJECTED')
                                                    @include('payments.partial.status_rejected')
                                                @endif

                                                @if($status == 'APPROVED_PARTIAL')
                                                    @include('payments.partial.status_approved_partial')
                                                @endif

                                                @if($status == 'PARTIAL_EXPIRED')
                                                    @include('payments.partial.status_partial_expired')
                                                @endif

                                                @if($status == 'FAILED')
                                                    @include('payments.partial.status_failed')
                                                @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    @endsection

