<div class="p-6">

    <form wire:submit="store">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-medium text-light">
                    {{ __('Tambahkan kategori') }}
                </h2>

                <p class="mt-1 text-sm text-neutral-400">
                    {{ __('Isi form di bawah ini untuk menambahkan kategori menu') }}
                </p>
            </div>
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

        <div class="mt-6 space-y-6 ">
            <div>
                <x-input-label for="name" value="{{ __('Nama kategori') }}" />
                <x-text-input wire:model.live="name" id="name" name="name" type="text"
                    class="mt-1 block w-full" autocomplete="off" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="description" value="{{ __('Deskripsi') }}" />
                <x-textarea wire:model.blur="description" id="description" description="description" type="number"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full">
                {{ __('Tambahkan menu') }}
            </x-primary-button>
        </div>
    </form>
</div>
