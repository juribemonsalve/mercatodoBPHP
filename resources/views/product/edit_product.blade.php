@extends('template.admin')
@section('content')
    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">
        <div class="flex flex-col mt-6">
            <div class="mx-auto">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Administración de Productos') }}</h2>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <div class="w-full max-w-md">
                    <div class="modal-content bg-gray-300 rounded-lg shadow">
                        <div class="modal-header flex items-center justify-center">
                            <h5 class="text-2xl font-bold text-orange-600" id="titulo_modal">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4 py-6">
                            <form action="{{ url('product/' .$product->id) }}" method="post">
                                @csrf
                                @method("PATCH")
                                <input type="hidden" name="id" id="id"  value="{{ $product->id }}" />
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-bold text-black">Nombre</label>
                                    <div class="input-group">
                                        <input id="name" name="name" type="text" value="{{ $product->name }}" maxlength="100" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Nombre">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-bold text-black">Descripción</label>
                                    <div class="input-group">
                                        <input id="description" name="description" type="text" value="{{ $product->description }}" maxlength="100" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Descripción">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="price" class="block text-sm font-bold text-black">Precio</label>
                                    <div class="input-group">
                                        <input id="price" name="price" type="number" value="{{ $product->price }}" min="0" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Precio">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="quantity" class="block text-sm font-bold text-black">Cantidad</label>
                                    <div class="input-group">
                                        <input id="quantity" name="quantity" type="number" value="{{ $product->quantity }}" min="0" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Cantidad">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="category_id" class="block text-sm font-bold text-black">Categoría Producto</label>
                                    <div class="input-group">
                                        <select name="category_id" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-bold text-black">Estado Producto</label>
                                    <select id="status" name="status" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" v-model="form.status" required>
                                        <option value="active" @if($product->status == 'active') selected @endif>Activo</option>
                                        <option value="disabled" @if($product->status == 'disabled') selected @endif>Desactivado</option>
                                    </select>
                                </div>
                                <div class="mt-8">
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                                    </button>
                                </div>
                                <div class="flex items-center justify-center mt-1">
                                    <a href="{{ url('/product/') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        <i class="fa-solid fa-times mr-2"></i> Cerrar
                                    </a>
                                </div>
                                @if (session('success'))
                                    <div class="bg-gray-300 text-green-700 px-4 py-3 rounded relative" role="alert">
                                        <span class="block sm:inline">{{ session('success') }}</span>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="bg-gray-300 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
