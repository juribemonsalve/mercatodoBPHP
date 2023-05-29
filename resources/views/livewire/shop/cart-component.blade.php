<div class="flex items-center">
    <a href="{{ route('cart') }}" class="bg-transparent text-orange-500 hover:text-orange-600 focus:text-orange-600 transition-colors duration-300">
        <i class="fas fa-shopping-cart"></i>
    </a>
    <span class="ml-1">{{ \Cart::getContent()->count() }}</span>
</div>




