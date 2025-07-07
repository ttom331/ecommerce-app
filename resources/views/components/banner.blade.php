<div class="relative h-[600px] w-full">
  <img
    src="{{ Vite::asset('resources/images/banner2.jpeg') }}"
    class="absolute inset-0 w-full h-full object-cover z-0"
    alt="Banner Image"
  />

  <div class="absolute inset-0 bg-black opacity-30 z-10"></div>

  <div class="relative z-20 flex items-center justify-center h-full">
    <div class="w-full max-w-screen-xl px-4 text-center">
      <h1 class="font-extrabold text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl leading-tight">
        Craft your dream home
      </h1>
      <x-button class="rounded-4xl mt-6 py-3 px-6 text-sm md:text-base font-bold uppercase">
        Shop Now
      </x-button>
    </div>
  </div>
</div>
