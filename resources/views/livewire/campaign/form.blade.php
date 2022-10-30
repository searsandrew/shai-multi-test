<div class="col-span-6 grid grid-cols-6 gap-3">
    <div class="col-span-6 lg:col-span-4">
        <x-jet-label for="campaign.name" value="{{ __('Name') }}" />
        <x-jet-input id="campaign.name" type="text" class="mt-1 block w-full" wire:model.defer="campaign.name" autocomplete="campaign.name" />
        <x-jet-input-error for="campaign.name" class="mt-2" />
    </div>
    <div class="col-span-6 lg:col-span-4 grid grid-cols-2 gap-x-3">
        <div class="mb-3">
            <x-jet-label for="campaign.started_at" value="{{ __('Start Date') }}" />
            <x-pikaday wire:model.defer="campaign.started_at" class="mt-1 block w-full h-10" id="campaign.started_at"/>
            <x-jet-input-error for="campaign.started_at" class="mt-2" />
        </div>
        <div class="mb-3">
            <x-jet-label for="campaign.ended_at" value="{{ __('End Date') }}" />
            <x-pikaday wire:model.defer="campaign.ended_at" class="mt-1 block w-full h-10" id="campaign.ended_at"/>
            <x-jet-input-error for="campaign.ended_at" class="mt-2" />
        </div>
        <div class="col-span-2 grid grid-cols-3 gap-3">
            <h3 class="col-span-3 text-sm lighter text-slate-600 leading-wide uppercase mb-2">{{ __('Campaign Options') }}</h3>
            <div class="">
                <x-toggle-checkbox model-id="campaign.toggle_image">{{ __('Landing Page') }}</x-toggle-checkbox>
                <x-jet-input-error for="campaign.toggle_image" class="mt-2" />
            </div>
            <div class="">
                <x-toggle-checkbox model-id="campaign.toggle_family">{{ __('Group by Families') }}</x-toggle-checkbox>
                <x-jet-input-error for="campaign.toggle_family" class="mt-2" />
            </div>
            <div class="">
                <x-toggle-checkbox model-id="campaign.toggle_privacy">{{ __('Enhanced Privacy') }}</x-toggle-checkbox>
                <x-jet-input-error for="campaign.toggle_privacy" class="mt-2" />
            </div>
            @if($campaign->toggle_image)
                <div class="col-span-3">
                </div>
            @endif
            <h3 class="col-span-3 text-sm lighter text-slate-600 leading-wide uppercase mb-2">{{ __('Campaign Communication') }}</h3>
            <div class="mb-3">
                <x-toggle-checkbox model-id="campaign.toggle_transaction_email">{{ __('Send Transactional Emails') }}</x-toggle-checkbox>
                <x-jet-input-error for="campaign.toggle_transaction_email" class="mt-2" />
            </div>
            <div class="mb-3">
                <x-toggle-checkbox model-id="campaign.toggle_instruction_email">{{ __('Send Instructional Emails') }}</x-toggle-checkbox>
                <x-jet-input-error for="campaign.toggle_instruction_email" class="mt-2" />
            </div>
            <div class="mb-3">
                <x-toggle-checkbox model-id="campaign.toggle_reminder_email">{{ __('Send Reminder Emails') }}</x-toggle-checkbox>
                <x-jet-input-error for="campaign.toggle_reminder_email" class="mt-2" />
            </div>
        </div>
    </div>
</div>
