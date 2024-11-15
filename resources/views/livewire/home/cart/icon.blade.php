<a href="{{ route('cart') }}" wire:navigate class="w-14 h-14 flex justify-center items-center rounded-full bg-light text-black cursor-pointer relative">
    <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
        <rect width="256" height="256" fill="none" />
        <path d="M188,184H91.17a16,16,0,0,1-15.74-13.14L48.73,24H24" fill="none" stroke="currentColor"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
        <circle cx="92" cy="204" r="20" fill="none" stroke="currentColor" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="16" />
        <circle cx="188" cy="204" r="20" fill="none" stroke="currentColor" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="16" />
        <path d="M70.55,144H196.1a16,16,0,0,0,15.74-13.14L224,64H56" fill="none" stroke="currentColor"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
    </svg>

    <div
        class="w-4 h-4 flex items-center justify-center absolute top-2 right-2 text-xs p-1 bg-black border border-borderColor text-light rounded-full z-[60]">
        {{ $totalCart }}
    </div>
</a>
