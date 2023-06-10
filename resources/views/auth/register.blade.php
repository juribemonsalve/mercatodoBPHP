@extends('template.admin-guest')
@section('content')
    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full py-6">

        <div class="flex flex-col mt-6">

            <div class="flex items-center justify-center">
                <div class="w-full max-w-md">

                    <div class="modal-content bg-gray-300 rounded-lg shadow py-2">
                        <div class="modal-header flex items-center justify-center flex-grow">
                            <h5 class="text-3xl font-bold text-orange-600" id="titulo_modal">Formulario de Registro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4 py-2">

                            <div class="flex items-center justify-center">
                                <a href="/">
                                    <x-application-logo class="w-20 h-20 md:w-32 md:h-32 fill-current text-gray-500" />
                                </a>
                            </div>

                            <form id="frmNuevo" method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div>
                                    <x-input-label for="documentType" :value="__('Tipo de documento')" />
                                    <select name="documentType" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" >
                                        <option value="CC">CC</option>
                                        <option value="CE">CE</option>
                                        <option value="TI">TI</option>
                                        <option value="NIT">NIT</option>
                                        <option value="RUT">RUT</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('documentType')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="document" :value="__('Documento de identidad')" />
                                    <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('document')" autofocus autocomplete="document" placeholder="Documento"/>
                                    <x-input-error :messages="$errors->get('document')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="name" :value="__('Nombre')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus autocomplete="name" placeholder="Nombre"/>
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="surname" :value="__('Apellido')" />
                                    <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')"  autofocus autocomplete="surname" placeholder="Apellido"/>
                                    <x-input-error :messages="$errors->get('surname')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Correo Eléctronico')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"  autofocus autocomplete="email" placeholder="Correo"/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="mobile" :value="__('Número de teléfono')" />
                                    <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')"  autofocus autocomplete="mobile" placeholder="Teléfono"/>
                                    <x-input-error :messages="$errors->get('mobile')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="address" :value="__('Información de dirección')" />
                                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"  autofocus autocomplete="address" placeholder="Dirección"/>
                                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Contraseña')" />

                                    <x-text-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                     autocomplete="new-password" placeholder="Contraseña"/>

                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-1">
                                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation"  autocomplete="new-password" placeholder="Confirmar Contraseña"/>

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                                        {{ __('Ya estoy Registrado!') }}
                                    </a>

                                    <x-primary-button class="ml-4">
                                        {{ __('Registrar') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


