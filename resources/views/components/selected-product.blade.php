@props(['product'])

<div class="flex-col flex md:flex-row md:space-x-4">
    <div class="md:w-2/3 flex justify-center mt-5">
        <img class="justify-center items-center w-full h-full pt-4 py-10" src='{{$product->image2}}' />
    </div>
    <div class="md:w-1/3 mt-5 md:mt-10 px-4  uppercase ">
        <form method="POST" action="/basket" class="space-y-3">
            @csrf
            @method('POST')
            @php $canPurchase = false; @endphp
            <!-- Reviews -->
            <p class="text-2xs">(0 reviews)</p>
            <!-- Product Name -->
            <h1 class="text-2xl">{{ $product->name }}</h1>
            <x-forms.input name="product_id" type="hidden" value="{{ $product->id }}" />
            <!-- Catrgory -->
            <p class="text-[#5f5f5f] text-xs">{{ $product->category->name }}</p>
            <!-- Price -->
            <p class="text-m font-extrabold {{ $product->dealPrice ? ' text-red-600 line-through' : '' }}">£{{ $product->price }}</p>
            <x-forms.input name="price" type="hidden" value="{{ $product->price }}" />
            @if ($product->dealPrice)
            <p class="text-m font-extrabold text-center">£{{ $product->dealPrice }}</p>
            <x-forms.input name="deal_price" type="hidden" value="{{ $product->dealPrice }}" />
            @endif
            @php
            $stock = $product->stock;
            @endphp
            @if (count($product->colors) == 0)
            <input type="hidden" name="color_id" value="" />
            @php
            $availabilty = $stock === 0 ? "Out of Stock" : ($stock < 10 ? "Only $stock left in stock!" : "In Stock!" );
                @endphp
                <p>Availability: <span>{{ $availabilty }}</span></p>
                @endif

                @if ($product->colors && count($product->colors) > 0 )
                <p class="text-xs">Color: <span id="selectedColorName" class="font-semibold"></span></p>
                <div class="flex space-x-2">
                    @foreach ($product->colors as $color)
                    @php
                    $colorStock = $color->pivot->stock;
                    @endphp
                    <div class="flex">
                        <input
                            type="radio"
                            id="color-{{ $color->id }}"
                            name="color_id"
                            value="{{ $color->id }}"
                            class="hidden peer"
                            data-color-name="{{ $color->name }}"
                            data-color-availability="{{$colorStock === 0 ? "Out of Stock" : ($colorStock < 10 ? "Only $colorStock left in stock!" : "In Stock!") }}"
                            data-color-stock="{{ $colorStock }}"
                            required>
                        <label
                            for="color-{{ $color->id }}"
                            class="w-8 h-8 rounded-full cursor-pointer border-2 border-gray-300 peer-checked:border-black"
                            style="background-color: <?= $color->hexcode ?>;"
                            title="{{ $color->name }}"></label>
                    </div>
                    @endforeach
                </div>
                <p>Availability: <span id="selectedColorAvailability">Select a color</span></p>
                @else
                @endif

                <!-- Hidden if it has prooducts colors, only shows flex once slection and if stock === 0 it does not diplsay either-->
                <div class="space-x-5 {{ count($product->colors) || $product->stock === 0  ? 'hidden' : 'flex' }}" id="quantity-section">
                    <div class="flex items-center max-w-[8rem]">
                        <button type="button" id="decrementButton" class="bg-[#F8F8F8] border border-gray-300 py-3 px-4 h-10 text-center">
                            <svg class="w-2 h-3 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="number" id="quantity" name="quantity" class="bg-[#F8F8F8] border-x-0 border-y border-gray-300 h-10 text-center text-gray-900 text-sm block w-9 py-1.5 pl-1" min="1" max="{{ $stock }}" value="1" readonly required />
                        <button type="button" id="incrementButton" class="bg-[#F8F8F8] border border-gray-300 py-3 px-4 h-10 text-center">
                            <svg class="w-2 h-3 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                    <x-button id="addToBasketButton" class="w-full py-2 text-xs font-bold {{ (count($product->colors) && !$product->colors->first()?->pivot->stock) ? 'hidden' : '' }}">ADD TO BAG</x-button>
                </div>
                @if (session('success'))
                <x-alert class="text-green-600">{{ session('success') }}</x-alert>
                @endif
                @if (session('error'))
                <x-alert class="text-red-600 text-xs normal-case">{{ session('error') }}</x-alert>
                @endif



                <p class="text-xs">Description -</p>
                <p class="text-xs normal-case">{{$product->description}}</p>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const radioInput = document.querySelectorAll("input[name='color_id']");
        const colorName = document.getElementById('selectedColorName');
        const availabilityEl = document.getElementById('selectedColorAvailability');
        const basketButton = document.getElementById('addToBasketButton');
        const quantity = document.getElementById('quantity-section');
        const quantityInput = document.getElementById('quantity');

        //for the different colors 
        radioInput.forEach(input => {
            input.addEventListener('change', () => {
                colorName.textContent = input.dataset.colorName;
                const availability = input.dataset.colorAvailability;
                const isInStock = !availability.includes("Out of Stock");
                const colorStock = input.dataset.colorStock;

                availabilityEl.textContent = availability;
                quantityInput.max = colorStock;


                if (isInStock) {
                    basketButton.classList.remove('hidden');
                    quantity.classList.remove('hidden');
                    quantity.classList.add('flex');
                } else {
                    basketButton.classList.add('hidden');
                    quantity.classList.add('hidden');
                    quantity.classList.remove('flex');
                };
            });

            if (input.checked) {
                colorName.textContent = input.dataset.colorName;
            }
        });


        const decrementBtn = document.getElementById('decrementButton'); //in an if statement
        const incrementBtn = document.getElementById('incrementButton');
        decrementBtn.addEventListener('click', function() {
            const min = parseInt(quantityInput.min) || 1;
            //set current value to current value, if invalid set to 1
            let currentValue = parseInt(quantityInput.value) || 1;
            //checks if current value is greater than the min o prevent going under min vlaue
            if (currentValue > min) {
                quantityInput.value = currentValue - 1;
            };
        });

        incrementBtn.addEventListener('click', function() {
            const max = parseInt(quantityInput.max) || 99;
            //set current value to current value, if invalid set to 1
            let currentValue = parseInt(quantityInput.value) || 1;
            //checks if current value is greater than the min o prevent going under min vlaue
            if (currentValue < max) {
                quantityInput.value = currentValue + 1;
            };
        });
    })
</script>