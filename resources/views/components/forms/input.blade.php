@props(['name', 'label' => '', 'type' => 'text'])

@php

    $defaults = [
        'type' => $type, 
        'id' => $name,
        'name' => $name, 
        'class' => "rounded border-1 border-gray-400 w-full px-5 py-4",
        'value' => old($name),
    ];

@endphp

<x-forms.field :$name :$label>
    <input {{ $attributes($defaults) }} />
</x-forms.field>