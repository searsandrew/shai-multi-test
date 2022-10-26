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
                    <div class="gap-3">
                        @if($campaign->recipients->count() > 0)
                            <span class="link mb-3" wire:click="$toggle('toggleRecipients')">
                                @if($toggleRecipients)
                                    {{ __('View Campaign Details') }}
                                @else
                                    {{ __('View Recipients') }}
                                @endif
                            </span>
                        @else
                            <span class="link mb-3" wire:click="$toggle('toggleUpload')">{{ __('Upload Recipients') }}</span>

                            @if($toggleUpload)
                                <form class="mt-6" method="POST" enctype="multipart/form-data" action="{{ route('recipient.import') }}">
                                    @csrf
                                    <input type="hidden" name="campaign" value="{{ $campaign->uuid }}" />
                                    <input type="file" name="file" />
                                    <button type="submit"  class="btn-muted text-center">Submit</button>
                                </form>
                            @endif
                        @endif
                        <a class="link mb-3" href="{{ route('campaign.label', $campaign) }}">Download Labels</a>
                    </div>
                </x-slot>

                <x-slot name="form">
                    @if($toggleRecipients)
                        <div class="col-span-6 divide-y">
                            @foreach($campaign->recipients as $recipient)
                                <div class="flex flex-cols items-center">
                                    <span class="w-1/6">{{ $recipient->ref_id }}</span>
                                    <span class="w-1/3">{{ $recipient->name }}</span>
                                    <span class="w-1/3">{{ $recipient->internal_ref_slug }}</span>
                                    <span class="w-1/6">{{ $recipient->family }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <livewire:campaign.form :campaign="$campaign" />
                    @endif
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