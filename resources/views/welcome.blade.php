<x-layout>
    <x-banner></x-banner>
    <div class="mx-auto max-w-[950px]">
        <x-heading>Shop by category</x-heading>
        <x-category :$categories />
        <div class="relative py-2">
            <div class="absolute bg-black  w-full opacity-10"></div>
            <img class="w-full object-contain" src="{{ Vite::asset('resources/images/newrange.png') }}">
            <h1 class="absolute top-2/5 left-[9%] transform -translate-y-1/2 font-extrabold text-white text-2xl sm:text-xl md:text-3xl lg:text-5xl xl:text-6xl ">New range handmade for your home!</h1>
            <x-button class="py-1 px-1 sm:py-2 sm:px-2 md:px-8 mt-1 md:mt-0 text-4xs sm:text-1xs md:text-xs text-[#4e4e4e] font-bold absolute top-[70%] left-[9%] transform -translate-y-1/2 uppercase">View Our New Range</x-button>
        </div>
        <x-heading>Featured Products</x-heading>
        <div class="px-2 sm:px-4 md:px-0 pb-10">
            <div class="mt-5 grid grid-cols-2 md:grid-cols-4 pb-2 gap-1">
                @foreach ($featuredProducts as $featuredProduct)
                <x-product-card :featuredProduct="$featuredProduct" />
                @endforeach
            </div>
        </div>
    </div>
</x-layout>