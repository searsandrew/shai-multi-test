<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $campaign->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-form-section>
                <x-slot name="title">
                    {{ __('Manage Campaign') }}
                </x-slot>

                <x-slot name="description">
                    <p>{{ __('Change details regarding your campaign, or upload a list of recipients.') }}</p>
                    <small>{{ __('There are several types of campaigns available, and depending on the type of campaign you are running, you may have different options.') }}</small>
                    <hr class="my-3" />
                    <a href="#">{{ __('View Recipients') }}</a>
                </x-slot>

                <x-slot name="form">
                    <livewire:campaign.form :campaign="$campaign" />
                </x-slot>
                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="campaignSaved">
                        {{ __('Saved.') }}
                    </x-jet-action-message>

                    <x-jet-button wire:loading.attr="disabled" wire:click="$emitTo('campaign.form', 'saveForm')">
                        {{ __('Save') }}
                    </x-jet-button>
                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>