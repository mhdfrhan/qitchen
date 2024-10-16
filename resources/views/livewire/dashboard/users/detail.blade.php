<div class="p-6">
    @if ($user)
        <div>
            <h2 class="text-xl font-medium text-light">
                {{ __('User ') . $user->name }}
            </h2>
            <p class="mt-1 text-sm text-textColor/60">
                This is information about {{ $user->name }}
            </p>
        </div>
        <div class="mt-6">
            <div>
                <div class="w-full overflow-x-auto">
                    <div class="min-w-max w-full border border-borderColor rounded-xl">
                        <table class="w-full">
                            <thead class="font-semibold uppercase text-neutral-500 text-sm border-b border-borderColor">
                                <tr>
                                    <th class="py-2 px-4 text-left">Name</th>
                                    <th class="py-2 px-4 text-left">Email</th>
                                    <th class="py-2 px-4 text-left">Phone</th>
                                    <th class="py-2 px-4 text-left">Role</th>
                                    <th class="py-2 px-4 text-left">Joined</th>
                                </tr>
                            </thead>
                            <tbody class=" text-sm">
                                <tr>
                                    <td class="py-2 px-4 text-left text-light">{{ $user->name }}</td>
                                    <td class="py-2 px-4 text-left text-neutral-400">{{ $user->email }}</td>
                                    <td class="py-2 px-4 text-left text-neutral-400">{{ $user->phone }}</td>
                                    <td class="py-2 px-4 text-left text-neutral-400">{{ $user->role }}</td>
                                    <td class="py-2 px-4 text-left text-neutral-400">
                                        {{ date('d M Y', strtotime($user->created_at)) }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($user->role == 'user')
            <div class="mt-6">
                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-3">
                    <div class="p-4 border border-borderColor rounded-xl text-center space-y-4">
                        <h3 class="text-neutral-400">Total Spending</h3>
                        <h1 class="text-xl font-bold leading-none text-light">
                            Rp.
                            {{ number_format(
                                $user->reservations->reject(function ($reservation) {
                                        return in_array($reservation->status, ['pending', 'cancelled']);
                                    })->sum('total_amount'),
                                0,
                                ',',
                                '.',
                            ) }}
                        </h1>
                    </div>
                    <div class="p-4 border border-borderColor rounded-xl text-center space-y-4">
                        <h3 class="text-neutral-400">Reservation Count</h3>
                        <h1 class="text-xl font-bold leading-none text-light">
                            {{ count($user->reservations) }}
                        </h1>
                    </div>
                    <div class="p-4 border border-borderColor rounded-xl text-center space-y-4">
                        <h3 class="text-neutral-400">Loyalty Points</h3>
                        <h1 class="text-xl font-bold leading-none text-light">
                            {{ number_format($user->loyalty_points, 0, ',', '.') }}
                        </h1>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-6">
            <form wire:submit.prevent='updateUser'>
                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-3 mb-4">
                    <div>
                        <x-input-label for="name">Name</x-input-label>
                        <x-text-input type="text" id="name" wire:model='name' class="w-full mt-1"
                            autocomplete="off" />
                    </div>
                    <div>
                        <x-input-label for="email">Email</x-input-label>
                        <x-text-input type="email" id="email" wire:model='email' class="w-full mt-1"
                            autocomplete="off" />
                    </div>
                    <div>
                        <x-input-label for="phone">Phone</x-input-label>
                        <x-text-input type="text" id="phone" wire:model='phone' class="w-full mt-1"
                            autocomplete="off" />
                    </div>
                    <div>
                        <x-input-label for="newPassword">New Password</x-input-label>
                        <x-text-input type="password" id="newPassword" wire:model='newPassword' class="w-full mt-1" />
                    </div>
                    <div>
                        <x-input-label for="status">Status</x-input-label>
                        <x-select-input class="w-full mt-1" wire:model='status'>
                            <option class="bg-neutral-800 text-light" value="user">User</option>
                            <option class="bg-neutral-800 text-light" value="admin">Admin</option>
                        </x-select-input>
                    </div>
                </div>
                <div class="text-right">
                    <x-primary-button type="submit">Update User</x-primary-button>
                </div>
            </form>
        </div>
    @endif
</div>
