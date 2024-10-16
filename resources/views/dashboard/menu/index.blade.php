<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-alert />
    <section>
        <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h3 class="text-2xl font-bold">{{ $title }}</h3>
                <p class="text-neutral-500">Page to add food categories and lists</p>
            </div>
            <div class="inline-flex items-center gap-3">
                <div>
                    <x-dark-button x-data="" class="flex items-center"
                        x-on:click.prevent="$dispatch('open-modal', 'kategori-create')">
                        <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <line x1="128" y1="40" x2="128" y2="216" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="22" />
                        </svg>
                        {{ __('Category') }}
                    </x-dark-button>

                    <x-modal name="kategori-create" :show="$errors->isNotEmpty()" max-width="lg" focusable>
                        <livewire:dashboard.kategori.create>
                    </x-modal>
                </div>
                <div>
                    <x-dark-button x-data="" class="flex items-center"
                        x-on:click.prevent="$dispatch('open-modal', 'menu-create')">
                        <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <line x1="128" y1="40" x2="128" y2="216" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="22" />
                        </svg>
                        {{ __('Menu') }}
                    </x-dark-button>

                    <x-modal name="menu-create" :show="$errors->isNotEmpty()" max-width="3xl" focusable>
                        <livewire:dashboard.menu.create>
                    </x-modal>
                </div>
            </div>
        </div>
        <livewire:dashboard.menu.category.index >
        <livewire:dashboard.menu.index>
    </section>
</x-app-layout>
