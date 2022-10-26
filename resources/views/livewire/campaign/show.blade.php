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
                    {{ __('Change details regarding your campaign, or upload a list of recipients.') }}
                    {{ __('There are several types of campaigns available, and depending on the type of campaign you are running, you may have different options.') }}
                    <hr class="my-3" />
                    @if($campaign->recipients->count() > 0)
                        <a href="#">{{ __('View Recipients') }}</a>
                    @else
                        <span class="link" wire:click="$toggle('toggleUpload')">{{ __('Upload Recipients') }}</a>

                        @if($toggleUpload)
                            <form class="mt-6" method="POST" enctype="multipart/form-data" action="{{ route('recipient.import') }}">
                                @csrf
                                <input type="hidden" name="campaign" value="{{ $campaign->uuid }}" />
                                <input type="file" name="file" />
                                <button type="submit"  class="btn-muted text-center">Submit</button>
                            </form>
                        @endif
                    @endif
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