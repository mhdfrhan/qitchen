@props(['disabled' => false, 'accept' => null])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-[#333330] focus:border-light focus:ring-light rounded-xl shadow-sm bg-transparent text-light placeholder:text-neutral-500 placeholder:text-sm py-2 px-3 file:border-0 file:bg-black file:text-light file:rounded file:text-sm file:py-1 file:px-2 file:mr-2 file:cursor-pointer']) !!} accept="{{ $accept }}">
