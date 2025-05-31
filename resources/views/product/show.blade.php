<x-layout>
    <div class="mx-auto max-w-[1440px]">
        <div class="flex space-x-4">
            <div class="w-2/3 flex justify-center mt-5">
                <img class="justify-center items-center w-full h-full pt-4 py-10" src='{{$product->image2}}' />
            </div>
            <div class="w-1/3 mt-10 font-extrabold uppercase space-y-2">
                <form action="POST" method="/basket">
                    @csrf
                    @method('POST')
                    <p>(0 reviews)</p>
                    <h1 class="text-3xl">{{ $product->name }}</h1>
                    <p class="text-[#5f5f5f]">{{ $product->category->name }}</p>
                    <p class="text-m font-extrabold {{ $product->dealPrice ? ' text-red-600 line-through' : '' }}">£{{ $product->price }}</p>
                    @if ($product->dealPrice)
                    <p class="text-m font-extrabold text-center">£{{ $product->dealPrice }}</p>
                    @endif
                    @if ($product->color)
                    @foreach ($product->color as $color)
                    <p>Color: {{ $color->name }}</p>
                    @endforeach
                    @endif
                    <x-button>Add to basket</x-button>
                </form>
            </div>
        </div>
        </form>
    </div>
    </div>
</x-layout>