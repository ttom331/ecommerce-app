@php
$method = $attributes->get('method', 'GET');  //retrieves the method, if nothing passed default to get
@endphp
<form  method="{{ in_array($method, ['GET', 'POST']) ? $method : 'POST' }}"  
        {{ $attributes->except('method')->merge(["class" => ""]) }}> <!-- method defaults to get-->
        
        
        @if ($attributes->get('method', 'GET') !== 'GET') 
        @csrf
        @method($attributes->get('method'))
    @endif

    {{ $slot }}
</form>