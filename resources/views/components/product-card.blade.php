@props(['product'])

<div class="px-4 text-[#5f5f5f] hover:outline-1 hover:bg-gray-200 outline-gray-200 rounded group">
    <img class="justify-center items-center h-25 pt-4" src='{{$product->image}}'/>
    <div class="px-2 text-center md:text-left mt-1">
        <span class="text-m font-extrabold text-center {{ $product->dealPrice ? ' text-red-600 line-through' : '' }}">£{{ $product->price }}</span>
        @if ($product->dealPrice)
            <span class="text-m font-extrabold text-center">£{{ $product->dealPrice }}</span>
        @endif
        <p class="text-xl font-black text-[#4e4e4e] cursor-pointer group-hover:underline transition-all duration-300">{{ $product->name }}</p>
        <p class="text-2xs font-extrabold hidden md:block h-25 md:h-20">{{ $product->description }}</p>
        <button class="border-1 border-[#929292] rounded-xl w-full text-xs text-white font-black mb-4 py-2 bg-[#00a896] hover:py-3 transition-all duration-300">Add to basket</button>
    </div>   
</div>