<!-- basket -->
<div id="guestBasket" class="fixed top-0 right-[-600px]  w-full md:w-[600px] h-full bg-white z-2550 flex flex-col transition-all duration-300 ease-in-out">
    <div class="flex relative">
        <h1 class="text-center mx-auto font-bold text-2xl md:text-m -tracking-tight py-2">My Shopping Basket</h1>
        <div id="closeGuestBasket" class="absolute right-0 top-1/2 transform -translate-y-1/2 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
        </div>
    </div>
    <hr class="border-gray-200">
    <div class="my-4">
        <p class="percentage text-center">Add £500 to reach free shipping! {{ $percentage }}%</p>
        <div class="mx-auto w-[95%] bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
            <div class="progress bg-[#00a896] h-2.5 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
        </div>
    </div>
    <hr class="border-gray-200" />
    <div class="overflow-y-auto">
        @if (count($guestBasket) > 0 )
        @foreach ($guestBasket as $item )
        <hr class="border-gray-200">
        <div class="quantity-section py-2 flex space-x-3 px-3" data-product-id="{{ $item['product']->id }}" data-color-id="{{ $item['color'] ? $item['color']->id : '' }}">
            <div>
                <img class="p-3 w-30 h-25" src="{{  $item['product']->image}}" />
            </div>
            <div class="flex flex-col flex-1">
                <div class="py-3 flex justify-between items-center">
                    <div class="flex flex-col">
                        <h1 class="text-sm uppercase">{{ $item['product']->name }}</h1>
                        @if ($item['color'])
                        <p class="text-xs">Color: {{ $item['color']->id }}</p> <!--$item['color']->pivot->stock -->
                        @endif
                    </div>
                    <div class="flex text-m md:text-xs font-bold">
                        <p>£</p>
                        <p class="price">{{ $item['price'] * $item['quantity'] }}</p>
                    </div>
                </div>
                <div class="flex justify-between items-center my-auto">
                    <x-forms.form-no-styling method="PATCH" action="/basket">
                        <div class="space-x-5 my-auto">
                            <div class="flex items-center max-w-[8rem]">
                                <input type="hidden" name="color_id" value="{{ $item['color'] ? $item['color']->id : ""}}" />
                                <input type="hidden" name="product_id" value="{{ $item['product']->id }}" />
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] }}" />
                                <input type="hidden" name="quantity_action" class="quantityAction" value="none" />
                                <button type="button" class="decrementButton flex justify-center items-center bg-[#F8F8F8] border border-gray-300 py-3.5 px-3 h-4 text-center">
                                    <svg class="w-1 h-0.5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="number" name="quantity" class="quantityInput bg-[#F8F8F8] border-x-0 border-y border-gray-300 h-4 text-center text-gray-900 text-xs block w-10 py-3.5" min="1" max="{{ ($item['color']) ? $item['color']->pivot->stock : $item['product']->stock }}" value="{{ $item['quantity'] }}" readonly required />
                                <button type="button" class="incrementButton flex justify-center items-center bg-[#F8F8F8] border border-gray-300 py-3.5 px-3 h-4 text-center">
                                    <svg class="w-1 h-3 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </x-forms.form-no-styling>
                    <form method="POST" action="/basket">
                        @csrf
                        @method('delete')
                        <x-forms.input type="hidden" value="{{ $item['product']->id }}" name="product_id" />
                        <input type="hidden" value="{{ $item['color'] ? $item['color']->id : ""}}" name="color_id" />
                        <button class="text-xl md:text-xs cursor-pointer">Remove</button>
                    </form>
                </div>
            </div>
        </div>
        <hr class="border-gray-200">
        @endforeach

        @endif
    </div>
    <div class="flex flex-col space-y-2 mt-auto pb-4">
        <hr class="border-gray-200">
        <h1 class="font-bold text-center">Subtotal:</h1>
        <div class="flex my-auto text-center justify-center items-center mx-3 space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
            </svg>
            <h1>Shipping: {{ $percentage >= 100 ? 'Free' : '£5' }}</h1>
        </div>
        <x-forms.form-no-styling method="POST" action="/checkout">
            <div class="px-3 mt-2">
                <x-button class="uppercase font-black py-2 w-full">Checkout</x-button>
            </div>
        </x-forms.form-no-styling>
    </div>
</div>