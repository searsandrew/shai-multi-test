<div>
    <div class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition cursor-pointer" wire:click=$toggle('inviteToggle')">
        {{ __('Invite User to Organization') }}
    </div>

    <x-jet-dialog-modal wire:model="inviteToggle">
        <x-slot name="title">
            {{ __('Send Invite Link') }}
        </x-slot>

        <x-slot name="content">
            Weeeee
        </x-slot>

        <x-slot name="footer">
            Footer
        </x-slot>
    </x-jet-dialog-modal>
</div>