@extends('template.admin')
@section('content')
    <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">
        <div class="flex flex-col mt-6">
            <div class="mx-auto">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Administración de Categorias') }}</h2>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <div class="w-full max-w-md">
                    <div class="modal-content bg-gray-300 rounded-lg shadow">
                        <div class="modal-header flex items-center justify-center">
                            <h5 class="text-2xl font-bold text-orange-600" id="titulo_modal">Editar Categoria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4 py-6">
                            <form action="{{ url('category/' .$category->id) }}" method="post">
                                @csrf
                                @method("PATCH")
                                <input type="hidden" name="id" id="id"  value="{{ $category->id }}" />
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-bold text-black">Nombre</label>
                                    <div class="input-group">
                                        <input id="name" name="name" type="text" value="{{ $category->name }}" maxlength="50" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-bold text-black">Descripción</label>
                                    <div class="input-group">
                                        <input id="description" name="description" type="text" value="{{ $category->description }}" maxlength="255" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Descripción">
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                                    </button>
                                </div>
                                <div class="flex items-center justify-center mt-1">
                                    <a href="{{ url('/category/') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
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
