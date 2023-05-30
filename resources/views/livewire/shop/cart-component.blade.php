<div class="flex items-center">
    @if(\Cart::getContent()->count() > 0)
        <a href="{{ route('cart') }}" class="bg-transparent text-orange-500 hover:text-orange-600 focus:text-orange-600 transition-colors duration-300">
            <i class="fas fa-shopping-cart"></i>
        </a>
    @else
        <span class="text-orange-500">
            <i class="fas fa-shopping-cart"></i>
        </span>
    @endif
    <span class="ml-1">{{ \Cart::getContent()->count() }}</span>
</div>




