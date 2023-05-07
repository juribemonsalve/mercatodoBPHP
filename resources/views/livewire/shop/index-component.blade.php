<div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight w-full">

    <div class="flex flex-col mt-6">
      <div class="mx-auto">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-3xl font-bold text-black-900 dark:text-gray-800 leading-tight text-center">
            {{ __('Productos Disponibles') }}
          </h2>
        </div>
      </div>
    </div>


    <div class="flex flex-wrap -mx-4">

        @foreach($products as $product)
            <div class="w-full md:w-1/3 px-4 mb-4">
                <div class="bg-white rounded-lg shadow-lg hover:scale-105">
                    <img class="w-full h-64 object-cover object-center " src="{{ $product->cover_img }}" alt="Card image">
                    <div class="p-4">

                        <div class="flex items-center mt-2">
                            <i class="fas fa-info-circle text-gray-800 mr-2"></i>
                            <p class="text-md">Nombre del Producto: {{ $product->name }}</p>
                        </div>

                        <div class="flex items-center mt-2">
                            <i class="fas fa-info-circle text-gray-400 mr-2"></i>
                            <p class="text-lg">Descripción: {{ $product->description }}</p>
                        </div>

                        <div class="flex items-center mt-2">
                            <i class="fas fa-dollar-sign text-gray-800 mr-2"></i>
                            <p class="text-sm">Precio: {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>

                    </div>
                    <div class="p-4 bg-gray-100 flex items-center justify-between">
                        <a href="" class="text-blue-500 font-semibold flex items-center">
                            <i class="fas fa-shopping-cart text-blue-500 mr-1"></i>
                            <span>Agregar al carrito</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
