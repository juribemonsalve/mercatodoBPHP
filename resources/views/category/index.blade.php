@extends('template.admin')
    @section('content')



                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

                    <div class="flex flex-col mt-6">
                        <div class="mx-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Administración de Categorias') }}</h2>
                        </div>
                    </div>

                    <div class="flex items-center justify-start mb-4 ml-auto">
                        <a href="{{ url('/category/create') }}" class="px-4 py-2 font-bold flex items-center text-white bg-gray-800 rounded-md shadow-md hover:bg-gray-700">
                            <i class="fa-solid fa-circle-plus"></i> Añadir Categoría
                        </a>
                    </div>

                    <div class="flex flex-col my-1 w-full">
                      <div class="mx-auto">
                        <div class="flex items-center justify-between my-2 w-full">
                          <form action="{{ route('category.index') }}" method="get">
                            <div class="flex items-center w-full">
                              <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="texto" value="{{$search}}" placeholder="Nombre o Descripción">
                              <button type="submit" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-r-md bg-blue-500 hover:bg-blue-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 18h4m-2-2v-4m2 4v4m-4-4H6a4 4 0 1 1 0-8h4a4 4 0 1 1 0 8z"></path>
                                </svg>
                                Buscar
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">
                                <div class="table-responsive">
                                    <table class="w-full divide-y divide-orange-500">
                                        <thead class="bg-orange-400-50">
                                            <tr>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong>{{ __('ID') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong>{{ __('Nombre') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/3"><strong>{{ __('Descripción') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong class="text-center">{{ __('Acciones') }}</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @if(count($categories)<=0)
                                                <tr>
                                                    <td colspan="8"> No hay resultados</td>
                                                </tr>
                                            @else
                                            @php $i=1; @endphp
                                             @foreach ($categories as $category)
                                                <tr>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $category->id }}</td>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $category->name }}</td>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/3 whitespace-nowrap">{{ $category->description}}</td>
                                                  <td class="px-1 py-1 text-sm font-medium text-center">

                                                    <a href="#" class="text-blue-400 hover:text-orange-500 font-extrabold" {{ $category->id }}">
                                                      <i class="fa-solid fa-edit"></i>Editar
                                                    </a>

                                                    <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        @if ($errors->has('error'))
                                                            <script>
                                                                // Mostrar el mensaje emergente
                                                                window.onload = function() {
                                                                    alert('{{ $errors->first('error') }}');
                                                                };
                                                            </script>
                                                        @endif

                                                        <button type="submit" onclick="return confirm('¿Desea eliminar esta categoría?');" class="text-black-300 hover:text-black font-extrabold">
                                                            <i class="fa-solid fa-trash font-extrabold"></i>Eliminar
                                                        </button>
                                                    </form>
                                                  </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($categories->total() >= 10)
                            <div class="d-flex justify-content-center mt-4">
                                <div class="bg-transparent rounded-lg p-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="h4 fw-bold me-2">Páginas:</div>
                                        <div class="ms-2 text-primary">
                                            {{ $categories->appends(['search' => $search])->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>


                    @foreach ($categories as $category)
                        <div class="modal fade" id="modalEdit{{ $category->id }}" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="bg-gray-300 rounded-lg py-8 px-4 shadow-sm sm:px-10">
                                <div class="modal-header">
                                  <h5 class="text-2xl font-bold text-black">Editar Categoria</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form id="frmEdit" method="POST" action="{{ route('category.update', $category->id) }}">
                                    @csrf
                                    @method('PUT')
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
                                      <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                                      </button>
                                      <button type="button" id="btnCerrar" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-times"></i> Cerrar
                                      </button>
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
                    @endforeach

                    <div class="modal fade" id="modalNuevo" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-gray-300 rounded-lg shadow">
                                <div class="modal-header">
                                    <h5 class="text-2xl font-bold text-black" id="titulo_modal">Nueva Categoria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-4 py-6">
                                    <form id="frmNuevo" method="POST" action="{{route('category.store')}}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="name" class="block text-sm font-bold text-black">Nombre</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-user-circle"></i></span>
                                                <input type="text" name="name" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="30" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="description" class="block text-sm font-bold text-black">Descripción</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                <input type="text" name="description" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="255" placeholder="Descripción">
                                            </div>
                                        </div>
                                        <div class="mt-8">
                                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                                            </button>
                                            <button type="button" id="btnCerrar" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-bs-dismiss="modal">
                                                <i class="fa-solid fa-times"></i> Cerrar
                                            </button>
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
                <script>
                    document.getElementById('search-text').addEventListener('input', function() {
                        if (this.value === '') {
                            location.reload();
                        }
                    });
                </script>
    @endsection
