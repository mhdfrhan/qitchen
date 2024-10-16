<div>
    <div class="w-full bg-white p-6 rounded-2xl shadow-lg shadow-neutral-200">
        <div class="flex flex-wrap gap-3 justify-between mb-6">
            <div class="w-full max-w-xs">
                <x-text-input wire:model.live="search" class="w-full border-neutral-200 focus:border-black !text-black"
                    placeholder="Search..." />
            </div>
            <div class="flex items-center gap-3">
                <div>
                    <x-select-input wire:model.live='filterStatus'
                        class='w-full border-neutral-300 focus:border-black !text-black'>
                        <option class="bg-black text-light" value="user">Customers</option>
                        <option class="bg-black text-light" value="admin">Admin</option>
                        <option class="bg-black text-light" value="koki">Koki</option>
                        <option class="bg-black text-light" value="kasir">Kasir</option>
                    </x-select-input>
                </div>
            </div>
        </div>
        <div class="w-full overflow-auto">
            <div class="min-w-max">
                <table class="w-full text-sm text-left">
                    <thead class="uppercase font-bold text-neutral-500">
                        <tr>
                            <th scope="col" class="py-3 px-4 border-b text-center">#</th>
                            <th scope="col" class="py-3 px-4 border-b">Name</th>
                            <th scope="col" class="py-3 px-4 border-b">Email</th>
                            <th scope="col" class="py-3 px-4 border-b">Phone</th>
                            <th scope="col" class="py-3 px-4 border-b">Role</th>
                            <th scope="col" class="py-3 px-4 border-b">CreatedAt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $i => $user)
                            <tr class="hover:bg-neutral-200/70 cursor-pointer border-b last:border-0"
                                wire:key="{{ $user->id }}" wire:click="selectUser({{ $user->id }})">
                                <td class="py-3 px-4 text-center">{{ $users->firstItem() + $i }}</td>
                                <td class="py-3 px-4 capitalize font-semibold">{{ $user->name }}</td>
                                <td class="py-3 px-4">{{ $user->email }}</td>
                                <td class="py-3 px-4">{{ $user->phone ? $user->phone : '-' }}</td>
                                <td class="py-3 px-4">{{ $user->role }}</td>
                                <td class="py-3 px-4">{{ date('d M Y', strtotime($user->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>

    <x-modal name="user-detail" :show="$errors->isNotEmpty()" max-width="4xl" focusable>
        @if ($selectedUserId)
            <livewire:dashboard.users.detail :user-id="$selectedUserId" :key="$selectedUserId" />
        @endif
    </x-modal>
</div>
