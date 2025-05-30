<x-layout>
    <x-heading>{{ ucfirst($category->name) }}</x-heading>
    <div class="py-8">
        <hr class="text-gray-300">
        <div class="py-3 space-x-6 text-center text-m">
            @foreach ($category->subCategories as $subCategory )
            <a href="{{ route('subcategory.show', ['name' => $category->name, 'subcategory' => $subCategory->slug ]) }}" class="{{ $subCategory->name == $subcat->name ? "font-extrabold text-[#00a896]" : "" }}">{{ $subCategory->name }}</a>
            @endforeach
        </div>
        <hr class="text-gray-300">
    </div>
    <div class="mx-auto max-w-[950px]">
        <div class="flex justify-center space-x-12 md:justify-between md:space-x-0 md:px-5">
            <div class="text-sm">
                {{ Breadcrumbs::render('subcategory.show', ucfirst($category->name), $subcat->name) }}
            </div>
            <x-filter/>
        </div>
        <div class="px-2 sm:px-4 md:px-0 pb-10">
            <div class="mt-5 grid grid-cols-2 md:grid-cols-4 pb-2 gap-1">
                @foreach ($subcat->products as $product )
                <x-product-card :product="$product"></x-product-card>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>