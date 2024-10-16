<div>
    <div class="flex flex-wrap gap-2 justify-center w-full max-w-md mx-auto">
        @foreach ($menuCategory as $category)
            <button type="button" wire:click="filterByCategory({{ $category->id }})"
                class="border py-1 px-2 text-xs border-borderColor rounded uppercase hover:bg-neutral-800 duration-300 {{ $selectedCategory === $category->id ? 'bg-neutral-800 text-white' : '' }}">
                {{ $category->name }}
            </button>
        @endforeach
        <button type="button" wire:click="toggleHalalFilter"
            class="border py-1 px-2 text-xs border-borderColor rounded uppercase hover:bg-neutral-800 duration-300 {{ $isHalal ? 'bg-green-500 text-white' : '' }}">
            Halal
        </button>
    </div>
    <div class="mt-12 max-w-2xl mx-auto">
        @foreach ($menuCategory as $category)
            @if ($menus->where('category_id', $category->id)->isNotEmpty())
                <div class="w-full mb-8 last:mb-0">
                    <div class="flex items-center justify-center gap-5 mb-6">
                        <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <line x1="12" y1="6.5" x2="30" y2="6.5" stroke="#333330" />
                            <rect x="6.5" y="0.48954" width="8.5" height="8.5" transform="rotate(45 6.5 0.48954)"
                                stroke="#333330" stroke-width="0.5" />
                        </svg>
                        <h2 class="text-3xl font-semibold text-center font-forum uppercase">{{ $category->name }}</h2>
                        <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <line x1="18.1362" y1="6.49988" x2="0.13623" y2="6.49988" stroke="#333330" />
                            <rect x="23.6362" y="12.5103" width="8.5" height="8.5"
                                transform="rotate(-135 23.6362 12.5103)" stroke="#333330" stroke-width="0.5" />
                        </svg>

                    </div>
                    <div class="flex flex-wrap -mx-4 gap-y-6 xl:gap-y-4 xl:block xl:mx-0">
                        @foreach ($menus->where('category_id', $category->id) as $menu)
                            <div class="w-full sm:w-1/2 px-4 xl:px-0 xl:block xl:w-full mb-4 last:mb-0">
                                <div
                                    class="hover:bg-neutral-800  border border-borderColor xl:border-0 p-3 rounded-xl duration-300 ease-in-out relative group">
                                    <div class="flex flex-wrap items-center -mx-4">
                                        <div class="w-full xl:w-1/3 px-4">
                                            <div class="w-full mb-4 xl:mb-0">
                                                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}"
                                                    class="rounded-lg w-full">
                                            </div>
                                        </div>
                                        <div class="w-full xl:w-2/3 px-4">
                                            <p
                                                class="text-xs font-medium {{ $menu->is_halal ? 'text-green-500' : 'text-red-500' }}">
                                                {{ $menu->is_halal ? 'Halal' : 'Non-Halal' }}</p>
                                            <div
                                                class="mb-3 flex items-end flex-none gap-4 flex-row h-min justify-start overflow-visible p-0 relative w-full mt-2">
                                                <h3
                                                    class="text-xl font-medium font-forum uppercase shrink-0 leading-none">
                                                    {{ $menu->name }}</h3>
                                                <div class="border-b w-full border-dashed border-borderColor"></div>
                                                <div class="shrink-0">
                                                    <p class="text-lg font-medium font-forum leading-none">Rp.
                                                        {{ number_format($menu->price) }}</p>
                                                </div>
                                            </div>
                                            <p class="text-textColor/70 text-sm leading-relaxed line-clamp-2">
                                                {{ $menu->description }}
                                            </p>
                                            <div class="mt-4 xl:mt-0 flex justify-end xl:block">
                                                <button type="button" wire:click="addToCart({{ $menu->id }})"
                                                    class="xl:absolute xl:bottom-2 xl:right-2 xl:opacity-0 xl:group-hover:opacity-100 duration-300 cursor-pointer flex xl:block items-center justify-end gap-2 xl:gap-0 bg-light xl:bg-transparent text-black py-2 px-4 xl:p-0 rounded-xl">
                                                    <div
                                                        class="xl:w-8 xl:h-8 xl:flex xl:items-center xl:justify-center xl:bg-light xl:rounded-full text-black">
                                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 256 256">
                                                            <rect width="256" height="256" fill="none" />
                                                            <path d="M188,184H91.17a16,16,0,0,1-15.74-13.14L48.73,24H24"
                                                                fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="16" />
                                                            <circle cx="92" cy="204" r="20" fill="none"
                                                                stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="16" />
                                                            <circle cx="188" cy="204" r="20" fill="none"
                                                                stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="16" />
                                                            <path d="M70.55,144H196.1a16,16,0,0,0,15.74-13.14L224,64H56"
                                                                fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="16" />
                                                        </svg>
                                                    </div>
                                                    <p class="font-bold font-forum xl:hidden">Add to Cart</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
