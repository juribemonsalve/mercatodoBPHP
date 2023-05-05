@extends('template.admin')
@section('content')
<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-gray-300 rounded-lg py-8 px-4 shadow sm:px-10">
        <h2 class="text-2xl font-bold text-black mb-6">Editar Usuario</h2>
        <form id="frmUsers" method="POST" action="{{route('user.update',$user->id)}}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-bold text-black">Nombre</label>
                <input id="name" name="name" type="text" value="{{ $user->name }}" maxlength="50" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Nombre" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold text-black">Correo</label>
                <input id="email" name="email" type="email" value="{{ $user->email }}" maxlength="50" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Correo" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-bold text-black">Estado</label>
                <select id="status" name="status" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" v-model="form.status" required>
                    <option value="active" @if($user->status == 'active') selected @endif>Activo</option>
                    <option value="disabled" @if($user->status == 'disabled') selected @endif>Desactivado</option>
                </select>
            </div>
            <div class="mt-8">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>





@endsection
