<div class="inline-flex items-center gap-3">
    <form wire:submit.prevent='changeStatus'>
        <x-select-input class="!text-black" wire:model='status'>
            <option value="confirmed">Confirmed</option>
            <option value="finished">Finished</option>
        </x-select-input>
        <x-dark-button type="submit">Change status</x-dark-button>
    </form>
</div>
