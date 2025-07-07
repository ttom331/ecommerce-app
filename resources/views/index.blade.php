<x-layout>
    <x-banner></x-banner>
    <div class="mx-auto max-w-[1440px]">
        <x-heading>Shop by category</x-heading>
        <x-category :$categories />
        <x-banner-custom text="View our new furniture range now!" button="View new range"/>
        <x-heading>Our featured products</x-heading>
        <div class="px-2 sm:px-4 md:px-0 pb-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-1">
                @foreach ($featuredProducts as $product)
                <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
        <x-heading>Design inspiriation for your home</x-heading>
        <x-lookbook :$lookbooks></x-lookbook>
    </div>
</x-layout>