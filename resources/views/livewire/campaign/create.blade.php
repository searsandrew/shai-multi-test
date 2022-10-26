<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Campaigns') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-jet-form-section submit="saveCampaign">
                <x-slot name="title">
                    {{ __('Create a Campaign') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Campaigns are your high-level organization of donations by season/event. Campaigns require their own branding in addition to a summary, start and end dates, and messages sent to donors.') }}<br/>
                    {{ __('There are several types of campaigns available, and depending on the type of campaign you are running, you will need to provide different donation specific information.') }}
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
            </x-jet-form-section>
        </div>
    </div>
</div>