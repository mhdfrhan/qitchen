<div class="p-6">

    <form wire:submit="update">

        <div class="flex items-start justify-between gap-3">
            <div>
                <h2 class="text-lg font-medium text-light">
                    {{ __('Update menu ') . $oldName }}
                </h2>

                <p class="mt-1 text-sm text-neutral-400">
                    {{ __('Please change the menu information below') }}
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
            @if ($image)
                <div>
                    <img class="w-64 object-cover rounded-xl" src="{{ $image->temporaryUrl() }}" alt="Preview Image" />
                </div>
            @else
                <div>
                    <img class="w-64 object-cover rounded-xl" src="{{ asset($oldImage) }}" alt="Preview Image" />
                </div>
            @endif
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="image" value="{{ __('Image') }}" />
                    <x-file-input wire:model.blur="image" id="image" name="image" type="file"
                        class="mt-1 block w-full" accept="image/*" placeholder="{{ __('Image') }}" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="category" value="{{ __('Category') }}" />
                    <x-select-input wire:model="category" id="category" name="category" class="mt-1 block w-full">
                        <option class="bg-black" value="">{{ __('Select Category') }}</option>
                        @foreach ($categories as $category)
                            <option class="bg-black" value="{{ $category->id }}"
                                wire:key="category-{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="name" value="{{ __('Name') }}" />
                    <x-text-input wire:model.live="name" id="name" name="name" type="text"
                        class="mt-1 block w-full" autocomplete="off" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="price" value="{{ __('Price') }}" />
                    <x-text-input wire:model.live="price" id="price" price="price" type="number"
                        class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
            </div>
            <div>
                <x-input-label for="description" value="{{ __('Description') }}" />
                <x-textarea wire:model.blur="description" id="description" description="description" type="number"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="flex items-center gap-4">
                <label for="is_halal" class="inline-flex items-center cursor-pointer">
                    <<input wire:model="is_halal" id="is_halal" type="checkbox"
                        class="rounded border-borderColor text-[#948968] shadow-sm focus:ring-light" name="is_halal"
                        {{ $is_halal ? 'checked' : '' }}>
                        <span class="ms-2 text-light select-none">{{ __('Halal Food') }}</span>
                </label>
                <label for="available" class="inline-flex items-center cursor-pointer">
                    <input wire:model="available" id="available" type="checkbox"
                        class="rounded border-borderColor text-[#948968] shadow-sm focus:ring-light" name="available"
                        {{ $available ? 'checked' : '' }}>
                    <span class="ms-2 text-light select-none">{{ __('Available') }}</span>
                </label>
            </div>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full">
                {{ __('Update menu') }}
            </x-primary-button>
        </div>
    </form>
</div>
