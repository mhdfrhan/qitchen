@props(['name' => '', 'disabled' => false, 'value' => null])
<select name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-[#333330] focus:border-light focus:ring-light rounded-xl shadow-sm bg-transparent text-light']) !!}>
   {{ $slot }}
</select>