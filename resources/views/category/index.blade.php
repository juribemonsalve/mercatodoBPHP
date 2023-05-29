@extends('template.admin')
    @section('content')

                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

                    <div class="flex flex-col mt-6">
                        <div class="mx-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Administración de Categorias') }}</h2>
                        </div>
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

                    <div class="container-fluid">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">
                                <div class="table-responsive">
                                    <div class="flex items-center justify-end mb-4">
                                        <a href="{{ url('/category/create') }}" class="px-2 py-2 font-bold flex items-center text-white bg-gray-800 rounded-md shadow-md hover:bg-gray-700">
                                            <i class="fa-solid fa-circle-plus"></i> Añadir Categoría
                                        </a>
                                    </div>
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
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $category->description}}</td>
                                                  <td class="px-1 py-1 text-sm font-medium text-center">

                                                    <a href="{{ url('/category/' . $category->id . '/edit') }}" class="text-blue-400 hover:text-orange-500 font-extrabold">
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
                </div>
                <script>
                    document.getElementById('search-text').addEventListener('input', function() {
                        if (this.value === '') {
                            location.reload();
                        }
                    });
                </script>
    @endsection
