@props(['product'])

<div class="text-[#5f5f5f] hover:outline-1 hover:bg-gray-200 outline-gray-200 rounded group">
    <img class="justify-center items-center h-40 xl:h-60 pt-4 px-6" src='{{$product->image}}' />
    <div class="px-2 flex flex-col mt-1 text-center ">
        <a href="{{ route('product.show', ['product' => $product->id]) }}">
            <p class="text-xl font-medium text-[#4e4e4e] cursor-pointer group-hover:underline transition-all duration-300">{{ $product->name }}</p>
        </a>
        <p class="text-2xs font-extrabold hidden md:block  md:h-15 overflow-hidden">{{ $product->description }}</p>
        <span class="text-m font-extrabold text-center {{ $product->dealPrice ? ' text-red-600 line-through' : '' }}">£{{ $product->price }}</span>
        @if ($product->dealPrice)
        <span class="text-m font-extrabold text-center">£{{ $product->dealPrice }}</span>
        @endif
        <a href="{{ route('product.show', ['product' => $product->id]) }}"><button class="opacity-0 group-hover:opacity-100 border-1 border-[#929292] w-full text-xs text-white font-black mb-4 py-5 bg-[#00a896] hover:py-6 transition-all duration-400">Shop Now</button></a>
    </div>
</div>