@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block items-center px-1 pt-1 border-l-2 border-light text-lg font-medium leading-5 text-light pl-4 focus:outline-none duration-300 ease-in-out'
            : 'block items-center px-1 pt-1 border-l-2 border-transparent text-lg font-medium leading-5 text-neutral-400 hover:text-light hover:border-light focus:outline-none hover:pl-4 duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
