@props(['disabled' => false, 'placeholder' => null])

<textarea {{ $disabled ? 'disabled' : '' }} cols="15" rows="8" {!! $attributes->merge([
    'class' =>
        'border-[#333330] focus:border-light focus:ring-light rounded-xl shadow-sm bg-transparent text-light placeholder:text-neutral-500 placeholder:text-sm',
]) !!}
    placeholder="{{ $placeholder }}">{{ $slot }}</textarea>
