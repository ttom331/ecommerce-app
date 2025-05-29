<div class="px-2 sm:px-4 md:px-0">
    <div class=" mt-5 grid grid-cols-2 md:grid-cols-4 gap-2">
        @foreach ($categories as $category)
            <a href="{{ route('category.show', ['name' => $category->name]) }}">
                <div class="bg-[#E6E3E4] cursor-pointer h-50 " aria-label="{{ $category->name }} ">
                    <img class="w-full h-full hover:opacity-50" src="{{  $category->img}}"/>
                </div>
                <p class="text-sm font-extrabold pt-1 text-[#3a3a3a] text-center">{{ ucfirst($category->name)  }}</p>
            </a>
        @endforeach
    </div>
</div>