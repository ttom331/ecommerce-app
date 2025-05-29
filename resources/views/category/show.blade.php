<x-layout>
    <x-heading>{{ ucfirst($category->name) }}</x-heading>
    <div class="py-8">
        <hr class="text-gray-300">
        <div class="py-3 space-x-6 text-center text-m">
            @foreach ($category->subCategories as $subCategory )
                <a>{{ $subCategory->name }}</a>
            @endforeach
        </div>
        <hr class="text-gray-300">
    </div>
</x-layout>