<div class="">
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-5 z-0 overflow-visible">
        @foreach ($lookbooks as $lookbook )
        <div class="bg-[#E6E3E4]  w-full h-[500px] cursor-pointer relative mb-3 overflow-visible z-10" aria-label="bedroom">
            <img class="w-full h-full object-cover" src='{{asset("images/lookbook/{$lookbook->image}") }}' />
            @foreach ($lookbook->items as $item)
            <div class="group">
                <div class="rounded-4xl h-7 w-7 bg-[#121212] opacity-65 border-2 border-[#929292] absolute" style="left: {{ $item->left_position }}%; top: {{ $item->top_position }}%">
                    <div class="absolute rounded-4xl top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2  h-3 w-3 bg-white opacity-100 group-hover:h-2 group-hover:w-2 transition-all duration-200"></div>
                </div>
                <div class=" flex items-center opacity-0 group-hover:opacity-100 transition-all duration-300 absolute bg-white mt-8 ml-8 p-2 whitespace-nowrap overflow-visible" style="left: {{ $item->left_position > 80 ? $item->left_position - 30 : $item->left_position }}%; top: {{ $item->top_position }}%">
                    <a href="{{ route('product.show', ['product' => $item->product->id]) }}">
                        <h1 class="font-bold">{{ $item->product->name }}</h1>
                        <span class="text-m font-extraboldr">£</span>
                        <span class="text-4xl font-extrabold">{{$item->product->price}}</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>