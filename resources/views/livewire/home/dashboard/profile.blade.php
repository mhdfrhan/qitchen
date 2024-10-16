<div>
    <x-alert />
    <div class="border-b pb-8 mb-8 border-borderColor">
        <div class="mb-4">
            <h3 class="text-xl font-semibold">Profile Information</h3>
            <p class="text-textColor/70 text-sm">Update your account's profile information and email address.</p>
        </div>
        <form wire:submit.prevent="updateProfileInformation" class="space-y-4 max-w-md">
            <div>
                <x-input-label class="mb-1.5" for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="w-full" wire:model.blur='name'
                    autocomplete="off" />
            </div>
            <div>
                <x-input-label class="mb-1.5" for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="w-full" wire:model.blur='email' />
            </div>
            <div>
                <x-input-label class="mb-1.5" for="phone" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="number" class="w-full" wire:model.blur='phone'
                    autocomplete="off" />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button class="w-full max-w-24">{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>
    <div>
        <div class="mb-4">
            <h3 class="text-xl font-semibold">Update Password</h3>
            <p class="text-textColor/70 text-sm">Ensure your account is using a long, random password to stay secure.
            </p>
        </div>
        <form wire:submit.prevent="updatePassword" class="space-y-4 max-w-md">
            @if (!Auth::user()->google_id)
                <div>
                    <x-input-label class="mb-1.5" for="current-password" :value="__('Current Password')" />
                    <x-text-input id="current-password" name="current-password" type="password" class="w-full"
                        wire:model.blur='current_password' autocomplete="off" />
                </div>
            @endif
            <div>
                <x-input-label class="mb-1.5" for="new-password" :value="__('New Password')" />
                <x-text-input id="new-password" name="new-password" type="password" class="w-full"
                    wire:model.blur='password' />
            </div>
            <div>
                <x-input-label class="mb-1.5" for="confirm-password" :value="__('Confirm Password')" />
                <x-text-input id="confirm-password" name="confirm-password" type="password" class="w-full"
                    wire:model.blur='password_confirmation' />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button class="w-full max-w-24">{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>
</div>
