<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-alert />
    <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
        <div>
            <h3 class="text-2xl font-bold">{{ $title }}</h3>
            <p class="text-neutral-500">Page for managing customers and admin</p>
        </div>
        <div class="inline-flex items-center gap-3">
            <div>
                <x-dark-button x-data="" class="flex items-center"
                    x-on:click.prevent="$dispatch('open-modal', 'user-create')">
                    <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="40" y1="128" x2="216" y2="128" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="128" y1="40" x2="128" y2="216" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="22" />
                    </svg>
                    {{ __('Users') }}
                </x-dark-button>

                <x-modal name="user-create" :show="$errors->isNotEmpty()" max-width="xl" focusable>
                    <livewire:dashboard.users.create>
                </x-modal>
            </div>
        </div>
    </div>
    <livewire:dashboard.users.index>
</x-app-layout>
