@props(['featuredProduct'])

<div class="px-4 text-[#5f5f5f] hover:outline-1 hover:bg-gray-200 outline-gray-200 rounded">
    <img class="justify-center items-center h-25 pt-4" src='{{$featuredProduct->image}}'/>
    <div class="px-2 text-center md:text-left">
        <span class="text-xs font-extrabold text-center {{ $featuredProduct->dealPrice ? ' text-red-600 line-through' : '' }}">£{{ $featuredProduct->price }}</span>
        @if ($featuredProduct->dealPrice)
            <span class="text-xs font-extrabold text-center">£{{ $featuredProduct->dealPrice }}</span>
        @endif
        <p class="text-xl font-black text-[#4e4e4e]">{{ $featuredProduct->name }}</p>
        <p class="text-2xs font-extrabold hidden md:block h-25 md:h-20">{{ $featuredProduct->description }}</p>
        <button class="border-1 border-[#929292] rounded-xl w-full text-2xs text-[#5f5f5f] font-black mb-4">Add to basket</button>
    </div>   
</div>