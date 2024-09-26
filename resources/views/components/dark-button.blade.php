<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex bg-black text-light text-center py-2 justify-center rounded-lg font-bold text-sm uppercase px-4']) }}>
   {{ $slot }}
</button>
