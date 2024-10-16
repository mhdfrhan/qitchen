<div class="mt-6">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
        <script type="text/javascript" src="{{ asset('js/trix.umd.min.js') }}"></script>
    @endpush
    <div class="bg-white rounded-2xl shadow-lg shadow-neutral-200 p-6 max-w-2xl">
        <form wire:submit.prevent='store' class="inline space-y-6">
            <div>
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview Gambar"
                        class="max-w-52 shadow-lg shadow-gray-200 rounded-lg mb-3">
                @endif
                <x-input-label class="!text-black !text-base" for="image">Image</x-input-label>
                <input type="file" id="image" name="image" wire:model.live='image' accept="image/*"
                    class="file:border-0 file:bg-black file:text-light file:rounded file:text-sm file:py-1 file:px-2 file:mr-2 file:cursor-pointer border border-neutral-300 focus:border-black focus:ring-black w-full rounded-lg py-2 px-4 mt-1">
                @error('image')
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                @enderror
            </div>
            <div>
                <x-input-label class="!text-black !text-base" for="title">Title</x-input-label>
                <x-text-input type="text" name="title" id="title"
                    class="w-full mt-1 border-neutral-300 focus:!border-black focus:!ring-black !text-black"
                    autocomplete="off" wire:model.live='title' />
                @error('title')
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                @enderror
            </div>
            <div>
                <x-input-label class="!text-black !text-base" for="slug">Slug</x-input-label>
                <x-text-input type="text" name="slug" id="slug"
                    class="w-full mt-1 border-neutral-300 focus:!border-black focus:!ring-black !text-black"
                    autocomplete="off" wire:model.live='slug' />
                @error('slug')
                    <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                @enderror
            </div>
            <div wire:ignore>
                <x-input-label class="!text-black !text-base" for="content" :value="__('Content')" />
                <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $value }}" required>
                <trix-editor input="{{ $trixId }}"></trix-editor>
            </div>
            @error('value')
                <x-input-error class="mt-2" :messages="$errors->get('content')" />
            @enderror
            <div class="mt-4 flex items-center gap-3">
                <x-primary-button type="button" wire:click="draft" class="w-full justify-center">Draft</x-primary-button>
                <x-dark-button type="submit" class="w-full">Publish</x-dark-button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            var trixEditor = document.getElementById("{{ $trixId }}")

            addEventListener("trix-blur", function(event) {
                @this.set('value', trixEditor.getAttribute('value'))
            })
        </script>
    @endpush
</div>
