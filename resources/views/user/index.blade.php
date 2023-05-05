@extends('template.admin')
@section('content')

    <div class="flex flex-col mt-6">
        <div class="mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Administración de Usuarios') }}</h2>
            {{--<button class="px-4 py-2 font-bold text-white bg-gray-800 rounded-md shadow-md hover:bg-gray-700" data-bs-toggle="modal" data-bs-target="#modalUser">
                    <i class="fas fa-user-plus mr-2"></i>{{ __('Añadir Usuario') }}
            </button>--}}
        </div>
    </div>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">
                    <table class="w-full divide-y divide-orange-500">
                        <thead class="bg-orange-400-50">
                            <tr>
                                <th scope="col" class="px-2 py-3 text-sm font-bold tracking-wider text-center text-orange-600 uppercase w-1/8"><strong>{{ __('ID') }}</strong></th>
                                <th scope="col" class="px-2 py-3 text-sm font-bold tracking-wider text-center text-orange-600 uppercase w-1/8"><strong>{{ __('Nombre') }}</strong></th>
                                <th scope="col" class="px-2 py-3 text-sm font-bold tracking-wider text-center text-orange-600 uppercase w-1/4"><strong>{{ __('Email') }}</strong></th>
                                <th scope="col" class="px-2 py-3 text-sm font-bold tracking-wider text-center text-orange-600 uppercase w-1/8"><strong>{{ __('Estado') }}</strong></th>
                                <th scope="col" class="px-2 py-3 text-sm font-bold tracking-wider text-center text-orange-600 uppercase w-1/8"><strong class="text-center">{{ __('Acciones') }}</strong></th>
                            </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $i=1; @endphp
                         @foreach ($users as $user)
                            <tr>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-gray-900 w-1/5">
                                    {{ $i++ }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-gray-900 w-1/5">
                                    {{ $user->name }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-gray-900 w-1/5">
                                    {{ $user->email }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-gray-900 w-1/5">
                                    {{ $user->status }}
                                </td>
                                <td class="px-1 py-1 whitespace-nowrap text-sm font-medium text-center">
                                <a href="#" class="text-blue-400 hover:text-orange-500 font-extrabold" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}">
                                    <i class="fa-solid fa-edit"></i>Editar
                                </a>



                                    <form method="POST" action="{{ route('user.destroy',$user->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('¿Desea eliminar este usuario?');" class="text-black-300 hover:text-black font-extrabold">
                                            <i class="fa-solid fa-trash font-extrabold"></i>Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>

    @foreach ($users as $user)

        <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="bg-orange-500 rounded-lg py-8 px-4 shadow-sm sm:px-10">
                        <div class="modal-header">
                            <h5 class="text-3xl font-bold text-white mb-5">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="frmUsers" method="POST" action="{{route('user.update',$user->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="name" class="block text-lg font-bold text-white">Nombre</label>
                                    <input id="name" name="name" type="text" value="{{ $user->name }}" maxlength="50" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Nombre" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-lg font-bold text-white">Correo</label>
                                    <input id="email" name="email" type="email" value="{{ $user->email }}" maxlength="50" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Correo" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-lg font-bold text-white">Estado</label>
                                    <select id="status" name="status" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" v-model="form.status" required>
                                        <option value="active" @if($user->status == 'active') selected @endif>Activo</option>
                                        <option value="disabled" @if($user->status == 'disabled') selected @endif>Desactivado</option>
                                    </select>
                                </div>
                                <div class="mt-8">
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-100 bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endforeach


@endsection
{{--
<div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-gray-300 rounded-lg shadow">
            <div class="modal-header">
                <h5 class="text-2xl font-bold text-black" id="titulo_modal">Añadir Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-6">
                <form id="frmUsers" method="POST" action="{{route('user.store')}}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-bold text-black">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="name" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="50" placeholder="Nombre" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-bold text-black">Correo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                            <input type="email" name="email" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="50" placeholder="Correo" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-bold text-black">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                            <input type="password" name="password" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="50" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-bold text-black">Estado</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
                            <select name="status" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="active">Activo</option>
                                <option value="disabled">Desactivado</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fa-solid fa-floppy-disk"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
            <button type="button" id="btnCerrar" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-bs-dismiss="modal">
              <i class="fa-solid fa-times"></i> Cerrar
            </button>

        </div>
    </div>
</div>


--}}
