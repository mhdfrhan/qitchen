<div class="w-full overflow-auto">
    <div class="min-w-max">
        @empty($menu->count())
            <div class="text-center text-sm text-neutral-400">
                {{ __('Menu not found') }}
            </div>
        @else
            <table class="w-full text-sm text-left">
                <thead class="uppercase font-bold">
                    <tr>
                        <th scope="col" class="py-2 px-4 border text-center">#</th>
                        <th scope="col" class="py-2 px-4 border">Image</th>
                        <th scope="col" class="py-2 px-4 border">Menu</th>
                        <th scope="col" class="py-2 px-4 border">Category</th>
                        <th scope="col" class="py-2 px-4 border">Status</th>
                        <th scope="col" class="py-2 px-4 border">Price</th>
                        <th scope="col" class="py-2 px-4 border text-center">ACtion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu as $i => $item)
                        <tr>
                            <td class="py-2 px-4 border text-center">{{ $i + 1 }}</td>
                            <td class="py-2 px-4 border">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="w-24 rounded-lg">
                            </td>
                            <td class="py-2 px-4 border">
                                <p class="line-clamp-2 capitalize">{{ $item->name }}</p>
                            </td>
                            <td class="py-2 px-4 border">{{ $item->category->name }}</td>
                            <td class="py-2 px-4 border">
                                <x-badge
                                    :status="$item->available">{{ $item->available == 1 ? 'Available' : 'Not Available' }}</x-badge>
                            </td>
                            <td class="py-2 px-4 border">Rp. {{ number_format($item->price) }}</td>
                            <td class="py-2 px-4 border">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" x-data="{ menuId: {{ $item->id }} }"
                                        x-on:click.prevent="$dispatch('set-menu-id', { id: menuId }); $dispatch('open-modal', 'menu-update')">
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                            <rect width="256" height="256" fill="none" />
                                            <path
                                                d="M92.69,216H48a8,8,0,0,1-8-8V163.31a8,8,0,0,1,2.34-5.65L165.66,34.34a8,8,0,0,1,11.31,0L221.66,79a8,8,0,0,1,0,11.31L98.34,213.66A8,8,0,0,1,92.69,216Z"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="16" />
                                            <line x1="136" y1="64" x2="192" y2="120" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                        </svg>
                                    </button>
                                    <button type="button" x-data="{ menuId: {{ $item->id }} }"
                                        x-on:click.prevent="$dispatch('set-menu-delete', { id: menuId }); $dispatch('open-modal', 'menu-delete')">
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                            <rect width="256" height="256" fill="none" />
                                            <line x1="216" y1="56" x2="40" y2="56" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                            <line x1="104" y1="104" x2="104" y2="168" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                            <line x1="152" y1="104" x2="152" y2="168" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                            <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                            <path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
    </div>

    <x-modal name="menu-update" :show="$errors->isNotEmpty()" max-width="3xl" focusable>
        @livewire('dashboard.menu.edit')
    </x-modal>

    <x-modal name="menu-delete" :show="$errors->isNotEmpty()" max-width="lg">
        <div class="p-6">
            <div class=" flex justify-end">
                <div>
                    <div class="w-8 h-8 inline-flex items-center justify-center rounded-full text-neutral-400 hover:text-light hover:bg-neutral-700/80 duration-300 cursor-pointer"
                        x-on:click="$dispatch('close')">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <line x1="200" y1="56" x2="56" y2="200" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <line x1="200" y1="200" x2="56" y2="56" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="text-center mt-2">
                <svg class="size-28 text-red-500 fill-red-500 mx-auto" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none" />
                    <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                        stroke-miterlimit="10" stroke-width="16" />
                    <line x1="128" y1="136" x2="128" y2="80" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <circle cx="128" cy="172" r="12" />
                </svg>

                <h2 class="text-3xl font-medium text-light  mt-2">
                    {{ __('Delete Menu') }}
                </h2>

                <p class="mt-1 text-sm text-neutral-400">
                    {{ __('Are you sure you want to delete this menu?') }}
                </p>
                <x-danger-button class="mt-6  mb-4" wire:click='deleteMenu' x-on:click="$dispatch('close')">
                    Delete Menu
                </x-danger-button>
            </div>
        </div>
    </x-modal>
</div>
