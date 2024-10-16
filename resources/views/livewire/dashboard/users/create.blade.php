<div class="p-6">
    <div>
        <h2 class="text-xl font-medium text-light">
            Create User
        </h2>
        <p class="mt-1 text-sm text-textColor/60">
            Fill in the form below to fill in the user data
        </p>
    </div>
    <div class="mt-6">
        <form wire:submit.prevent='createUser'>
            <div class="grid sm:grid-cols-2 gap-3 mb-4">
                <div>
                    <x-input-label for="name">Nama</x-input-label>
                    <x-text-input type="text" name="name" id="name" class="w-full mt-1" autocomplete="off"
                        wire:model.live='name' />
                </div>
                <div>
                    <x-input-label for="email">Email</x-input-label>
                    <x-text-input type="email" name="email" id="email" class="w-full mt-1" autocomplete="off"
                        wire:model.live='email' />
                </div>
                <div>
                    <x-input-label for="phone">Phone</x-input-label>
                    <x-text-input type="number" name="phone" id="phone" class="w-full mt-1" autocomplete="off"
                        wire:model.live='phone' />
                </div>
                <div>
                    <x-input-label for="role">Role</x-input-label>
                    <x-select-input class="w-full mt-1" id="role" name="role" wire:model='role'>
                        <option class="bg-black text-light" value="user">User</option>
                        <option class="bg-black text-light" value="admin">Admin</option>
                    </x-select-input>
                </div>
            </div>
            <div class="mb-6">
                <x-input-label for="password">Password</x-input-label>
                <x-text-input type="password" name="password" id="password" class="w-full mt-1" autocomplete="off"
                    wire:model.live='password' />
            </div>
            <x-primary-button class="w-full">Save User</x-primary-button>
        </form>
    </div>
</div>
