<div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full py-4">

        <div class="flex flex-col mt-2">
            <div class="mx-auto">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Checkout') }}</h2>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <div class="w-full max-w-md">

                    <div class="modal-content bg-gray-300 rounded-lg shadow">
                        <div class="modal-header flex items-center justify-center">
                            <h5 class="text-2xl font-bold text-orange-600" id="titulo_modal">Datos de facturación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4 py-6">

                            <form id="frmNuevo" method="POST" action="">
                                @csrf
                                <div class="mb-1">
                                    <label for="name" class="block text-sm font-bold text-black">Documento de identidad</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        <input
                                            type="text"
                                            class="form-control @error('document') is-invalid @enderror"
                                            wire:model="document"
                                        placeholder="Documento">
                                        @error('document')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="documentType" class="block text-sm font-bold text-black">Tipo de documento</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        <select name="documentType" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" >
                                            <option value="CC">CC</option>
                                            <option value="CE">CE</option>
                                            <option value="TI">TI</option>
                                            <option value="NIT">NIT</option>
                                            <option value="RUT">RUT</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="" class="block text-sm font-bold text-black">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            wire:model="name"
                                        placeholder="Nombre">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="" class="block text-sm font-bold text-black">Apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        <input
                                            type="text"
                                            class="form-control @error('surname') is-invalid @enderror"
                                            wire:model="surname"
                                        placeholder="Apellido">
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="" class="block text-sm font-bold text-black">Correo Eléctronico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        <input
                                            type="text"
                                            class="form-control @error('email') is-invalid @enderror"
                                            wire:model="email"
                                        placeholder="Correo">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="" class="block text-sm font-bold text-black">Número de teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        <input
                                            type="text"
                                            class="form-control @error('mobile') is-invalid @enderror"
                                            wire:model="mobile"
                                        placeholder="Teléfono">
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="" class="block text-sm font-bold text-black">Información de dirección</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        <input
                                            type="text"
                                            class="form-control @error('address') is-invalid @enderror"
                                            wire:model="address"
                                        placeholder="Dirección">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="" class="block text-sm font-bold text-black">Medio de Pago</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                               wire:model="payment_method"
                                               name="exampleRadios" id="exampleRadios2" value="placetopay">
                                        <label class="form-check-label" for="exampleRadios2">
                                            placetopay
                                            <img src="https://static.placetopay.com/placetopay-logo.svg" class="attachment-0x0 size-0x0" alt="">
                                        </label>
                                    </div>

                                </div>

                                <div class="mt-2">
                                    <button type="button" wire:click="make_order()" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="fas fa-save mr-2"></i> Realizar pedido
                                    </button>
                                </div>
                                <div class="flex items-center justify-center mt-1">
                                    <a href="{{ url('cart') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        <i class="fa-solid fa-times mr-2"></i> Regresar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
