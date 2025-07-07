@props(['product'])

<div class="text-[#5f5f5f] rounded group">
    <img class="justify-center items-center h-40 xl:h-60 py-8" src='{{asset("images/products/{$product->image}") }}' />
    <div class="px-2 flex flex-col mt-1 space-y-2">
        <a href="{{ route('product.show', ['product' => $product->id]) }}">
            <p class="text-xl font-bold text-[#4e4e4e] cursor-pointer group-hover:underline transition-all duration-300">{{ $product->name }}</p>
            <p class="text-xs font-bold text-[#6a6a6a] cursor-pointer ">{{ ucfirst($product->category->name) }}</p>
        </a>
        <p class="text-2xs font-extrabold hidden md:block  md:h-8 overflow-hidden">{{ $product->description }}</p>
        <div class="flex">
            <span class="text-m font-extrabold {{ $product->dealPrice ? ' text-red-600 line-through' : '' }}">£</span>
            <span class="text-2xl font-extrabold {{ $product->dealPrice ? ' text-red-600 line-through' : '' }}">{{ $product->price }}</span>
            @if ($product->dealPrice)
            <span class="text-m font-extraboldr">£</span>
            <span class="text-4xl font-extraboldr">{{ $product->dealPrice }}</span>
            @endif
        </div>
        <a href="{{ route('product.show', ['product' => $product->id]) }}"><button class="border-1 border-[#929292] w-25 text-xs text-white font-black mb-4 py-3 rounded-4xl bg-[#00a896] hover:bg-[#121212] hover:text-white cursor-pointer transition-all duration-400">Shop Now</button></a>
    </div>
</div>