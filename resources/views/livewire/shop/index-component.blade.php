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
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" name="search" value="{{$search}}" placeholder="Nombre o Estado">
                        <button type="submit" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-r-md bg-orange-500 hover:bg-orange-600 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
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



    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 py-3">

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

                        <button type="button" class="text-orange-600 font-semibold flex items-center" wire:click="add_to_cart({{$product->id}})">
                            <i class="fas fa-shopping-cart text-orange-600 mr-1"></i>
                            <span>Agregar al carrito</span>
                        </button>
                    </div>

                </div>
            @endforeach
        @endif
    </div>
    @if ($products->total() >= 10)

        <div class="d-flex justify-content-center mt-4">
            <div class="bg-transparent rounded-lg p-4">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="h4 fw-bold me-2">Paginas:</div>
                    <div class="ms-2 text-primary">{{ $products->appends(['search' => $search])->links() }}</div>
                </div>
            </div>
        </div>
    @endif
</div>


<script>
    document.getElementById('search-text').addEventListener('input', function() {
        if (this.value === '') {
            location.reload();
        }
    });
</script>
