@extends('template.admin')
    @section('content')



                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

                    <div class="flex flex-col mt-6">
                        <div class="mx-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-200 leading-tight text-center">{{ __('Administración de Productos') }}</h2>
                        </div>
                    </div>
                    <div class="flex items-center justify-start mb-4 ml-auto">
                        <button class="px-4 py-2 font-bold text-white bg-gray-800 rounded-md shadow-md hover:bg-gray-700" data-bs-toggle="modal" data-bs-target="#modalNuevo">
                            <i class="fa-solid fa-circle-plus"></i>{{ __('Añadir Productos') }}
                        </button>
                    </div>




                    <div class="flex flex-col my-1 w-full">
                      <div class="mx-auto">
                        <div class="flex items-center justify-between my-2 w-full">
                          <form action="{{ route('adminproduct.index') }}" method="get">
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


                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">
                                <div class="table-responsive">
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
                                                    <a href="#" class="text-blue-400 hover:text-orange-500 font-extrabold" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $product->id }}">
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
                                    {{$products->links()}}
                                </div>
                            </div>
                        </div>
                    </div>



                    @foreach ($products  as $product)
                        <div class="modal fade" id="modalEdit{{ $product->id }}" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                    <div class="modal-content">
                                          <div class="bg-gray-300 rounded-lg py-8 px-4 shadow-sm sm:px-10">
                                                <div class="modal-header">
                                                  <h5 class="text-2xl font-bold text-black">Editar Producto</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                              <div class="modal-body">
                                                      <form id="frmEdit" method="POST" action="{{ route('product.update', $product->id) }}">

                                                          @csrf
                                                          @method('PUT')
                                                          <div class="mb-4">
                                                              <label for="name" class="block text-sm font-bold text-black">Nombre</label>
                                                              <div class="input-group">
                                                                <input id="name" name="name" type="text" value="{{ $product->name }}" maxlength="100" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Nombre" required>
                                                              </div>
                                                          </div>

                                                          <div class="mb-4">
                                                              <label for="description" class="block text-sm font-bold text-black">Descripción</label>
                                                              <div class="input-group">
                                                                <input id="description" name="description" type="text" value="{{ $product->description }}" maxlength="100" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Descripción" required>
                                                              </div>
                                                          </div>

                                                          <div class="mb-4">
                                                                <label for="price" class="block text-sm font-bold text-black">Precio</label>
                                                                <div class="input-group">
                                                                    <input id="price" name="price" type="number" value="{{ $product->price }}" min="0" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Precio" required>
                                                                </div>
                                                          </div>

                                                          <div class="mb-4">
                                                                <label for="quantity" class="block text-sm font-bold text-black">Cantidad</label>
                                                                <div class="input-group">
                                                                    <input id="quantity" name="quantity" type="number" value="{{ $product->quantity }}" min="0" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500" placeholder="Cantidad" required>
                                                                </div>
                                                          </div>

                                                          <div class="mb-4">
                                                                <label for="category_id" class="block text-sm font-bold text-black">Categoría Producto</label>
                                                                <div class="input-group">
                                                                    <select name="category_id" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
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
                                                              <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                                                              </button>
                                                              <button type="button" id="btnCerrar" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-times"></i> Cerrar
                                                              </button>
                                                          </div>
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
                                    <h5 class="text-2xl font-bold text-black" id="titulo_modal">Nuevo Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-4 py-6">
                                    <form id="frmNuevo" method="POST" action="{{route('product.store')}}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="name" class="block text-sm font-bold text-black">Nombre</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-clipboard"></i></span>
                                                <input type="text" name="name" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="100" placeholder="Nombre" required>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="description" class="block text-sm font-bold text-black">Descripción</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-clipboard"></i></span>
                                                <input type="text" name="description" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="" placeholder="Descripción" required>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="price" class="block text-sm font-bold text-black">Precio</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                <input type="number" name="price" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="50" placeholder="Precio" required>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="quantity" class="block text-sm font-bold text-black">Cantidad</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-clipboard"></i></span>
                                                <input type="number" name="quantity" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" maxlength="" placeholder="Cantidad" required>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="quantity" class="block text-sm font-bold text-black">Categoría Producto</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                                <select name="category_id" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id}}">{{ $category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="status" class="block text-sm font-bold text-black">Estado Producto</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
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
                                            <button type="button" id="btnCerrar" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-bs-dismiss="modal">
                                                <i class="fa-solid fa-times"></i> Cerrar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection
