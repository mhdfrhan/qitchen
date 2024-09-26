<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex bg-light text-center py-2 justify-center rounded-lg font-bold text-sm uppercase px-4 text-black hover:bg-light/80 duration-300']) }}>
    {{ $slot }}
</button>
