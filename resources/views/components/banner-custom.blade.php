@props(['text' => 'No text given', 'button' => 'click here'])

<div class="relative h-[600px] w-full mt-3">
    <img
        src="{{ Vite::asset('resources/images/newrange.png') }}"
        class="absolute inset-0 w-full h-full object-cover z-0"
        alt="Banner Image" />

    <div class="absolute inset-0 bg-black opacity-30 z-10"></div>

    <div class="relative z-20 flex items-center justify-center h-full">
        <div class="w-full max-w-screen-xl px-4">
            <h1 class="font-extrabold text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl leading-tight">
                {{ $text }}
            </h1>
            <x-button class="py-1 px-1 sm:py-2 sm:px-2 md:px-8 mt-1 md:mt-4 text-4xs sm:text-1xs md:text-xs text-[#4e4e4e] font-bold uppercase">{{$button}}</x-button>
        </div>
    </div>
</div>