<x-layout>
    <x-heading>Basket</x-heading>
    @if (count($basket) > 0 )
        @foreach ($basket as $item )
            <p>{{ $item['product']->name }}</p>
            <p>{{ $item['price'] }}</p>
            <p>{{ $item['quantity']}}</p>
        
        @endforeach
    
    @endif
</x-layout>
