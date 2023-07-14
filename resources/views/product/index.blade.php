@extends('template.admin')
    @section('content')



                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

                    <div class="flex flex-col mt-6">
                        <div class="mx-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Administración de Productos') }}</h2>
                        </div>
                    </div>

                    <div class="flex flex-col my-1 w-full">
                      <div class="mx-auto">
                        <div class="flex items-center justify-between my-2 w-full">
                          <form action="{{ route('product.index') }}" method="get">
                            <div class="flex items-center w-full">
                              <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="texto" value="{{$texto}}" placeholder="Nombre o Descripción">
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

                                    <div class="flex">
                                      <div class="w-1/2">
                                        <div class="flex">
                                            <form action="{{ route('products.import') }}" method="post" enctype="multipart/form-data" class="flex">
                                                @csrf
                                                <div class="flex flex-wrap">
                                                    <div class="px-4">
                                                        <input type="file" name="document" class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    </div>
                                                    <div class="px-4">
                                                        <button class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-l-none rounded-r-md shadow-md hover:bg-blue-700" type="submit">
                                                            <span class="mr-2 fa-solid fa-circle-plus"></span>
                                                            Import
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="flex justify-start px-3">
                                            <form action="{{ route('products.export') }}" method="get" enctype="multipart/form-data" class="px-2">
                                                @csrf
                                                <button class="flex items-center px-4 py-2 text-white bg-green-500 rounded-md shadow-md hover:bg-green-600" type="submit">
                                                    <span class="mr-2 fa-solid fa-file-excel"></span>
                                                    Export
                                                </button>
                                            </form>
                                        </div>

                                      </div>
                                    </div>
                                    @if(session('message'))
                                            <div class="bg-green-500 text-white px-2 py-2 mt-2">
                                                {{ session('message') }}
                                            </div>
                                    @endif

                                    @if ($errors->any())
                                            <div class="bg-red-500 text-white px-2 py-2">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @endif


                                    <div class="flex items-center justify-end mb-4">
                                        <a href="{{ url('/product/create') }}" class="px-2 py-2 font-bold flex items-center text-white bg-gray-800 rounded-md shadow-md hover:bg-gray-700">
                                            <i class="fa-solid fa-circle-plus"></i> Añadir Producto
                                        </a>
                                    </div>
                                    <table class="w-full divide-y divide-orange-500">
                                        <thead class="bg-orange-400-50">
                                            <tr>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/8"><strong>{{ __('ID') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong>{{ __('Nombre') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/3"><strong>{{ __('Descripción') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/8"><strong>{{ __('Precio') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/8"><strong>{{ __('Cantidad') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong>{{ __('Categoria Producto') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/6"><strong>{{ __('Estado Producto') }}</strong></th>
                                                <th scope="col" class="px-2 py-2 text-sm font-bold  text-center text-orange-600 uppercase w-1/8"><strong class="text-center">{{ __('Acciones') }}</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @if(count($products)<=0)
                                                <tr>
                                                    <td colspan="8"> No hay resultados</td>
                                                </tr>
                                            @else



                                            @php $i=1; @endphp
                                             @foreach ($products as $product)
                                                <tr>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $product->id }}</td>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $product->name }}</td>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/3 whitespace-nowrap">{{ $product->description }}</td>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ number_format($product->price, 0, ',', '.') }}</td>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $product->quantity }}</td>
                                                  <td   class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">
                                                        @foreach($categories as $category)
                                                            @if($category->id == $product->category_id)
                                                                {{ $category->name }}
                                                            @endif
                                                        @endforeach
                                                  </td>
                                                  <td class="px-2 py-2 text-sm text-center text-gray-900 w-1/6">{{ $product->status}}</td>
                                                  <td class="px-1 py-1 text-sm font-medium text-center">

                                                    <a href="{{ url('/product/' . $product->id . '/edit') }}" class="text-blue-400 hover:text-orange-500 font-extrabold">
                                                      <i class="fa-solid fa-edit"></i>Editar
                                                    </a>

                                                    <form method="POST" action="{{ route('product.destroy',$product->id) }}">
                                                      @method('DELETE')
                                                      @csrf
                                                      <button type="submit" onclick="return confirm('¿Desea eliminar esta categoria?');" class="text-black-300 hover:text-black font-extrabold">
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
                        @if ($products->total() >= 10)
                                <div class="d-flex justify-content-center mt-4">
                                    <div class="bg-transparent rounded-lg p-4">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="h4 fw-bold me-2">Paginas:</div>
                                            <div class="ms-2 text-primary">
                                                {{ $products->appends(['texto' => $texto])->links() }}
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
