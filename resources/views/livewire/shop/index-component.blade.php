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

    <div class="flex flex-col my-1 w-full">
        <div class="mx-auto">
            <div class="flex items-center justify-between my-2">
                <form action="{{ route('inicio') }}" method="get" class="w-full">
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



    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

        @if(count($products) <= 0)
            <div class="col-span-3">
                <p class="text-center text-gray-600 py-8">No hay resultados</p>
            </div>
        @else
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transform transition duration-300 hover:scale-105">
                    <img class="w-full h-64 object-cover object-center rounded-t-lg" src="{{ $product->cover_img }}" alt="Card image">
                    <div class="p-4">

                        <div class="flex items-center mb-2">
                            <i class="fas fa-info-circle text-gray-800 mr-2"></i>
                            <p class="text-lg font-semibold">{{ $product->name }}</p>
                        </div>

                        <div class="mb-2">
                            <p class="text-gray-600">{{ $product->description }}</p>
                        </div>

                        <div class="flex items-center mb-2">
                            <i class="fas fa-dollar-sign text-gray-800 mr-2"></i>
                            <p class="text-sm">Precio: {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>

                    </div>
                    <div class="p-4 bg-gray-100 rounded-b-lg">
                        <a href="#" class="text-blue-500 font-semibold flex items-center">
                            <i class="fas fa-shopping-cart text-blue-500 mr-1"></i>
                            <span>Agregar al carrito</span>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

    </div>



    {{$products->links()}}
</div>

<script>
    document.getElementById('search-text').addEventListener('input', function() {
        if (this.value === '') {
            location.reload();
        }
    });
</script>
