@props(['class' => ''])

<span {{ $attributes->merge(['class' => "text-xs normal-case $class"]) }}> {{$slot}} </span>