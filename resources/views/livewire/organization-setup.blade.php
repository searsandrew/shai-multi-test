<div>
    <div class="py-12">
        <div class="max-w-4xl mx-auto shadow-xl">
            <img class="sm:rounded-t-lg" src="{{ asset('storage/img/shai-banner-slim.png') }}" />
            <div class="bg-white p-6 overflow-hidden sm:rounded-b-lg">
                <h1 class="text-lg text-slate-600">{{ __('Welcome to :Name', ['name' => config('app.name')]) }}</h1>
                <div class="flex flex-row gap-5">
                    <form class="grid grid-cols-6 gap-2" wire:submit.prevent="createOrganization">
                        <p class="col-span-6">{{ __('To get started, please either setup a new organization or enter the invite code you were given to join an existing organization.') }}</p>
                        <div class="flex flex-col flex-initial col-span-6 sm:col-span-3">
                            <x-jet-label for="organization.name" value="{{ __('Organization Name') }}" />
                            <x-jet-input id="organization.name" type="text" wire:model.defer="organization.name" required />
                            <x-jet-input-error for="organization.name" class="mt-2" />
                        </div>
                        <div class="flex flex-col flex-initial col-span-6 sm:col-span-3">
                            <x-jet-label for="organization.tax_id" value="{{ __('Organization Tax ID') }}" />
                            <x-jet-input id="organization.tax_id" type="text" wire:model.defer="organization.tax_id" />
                            <x-jet-input-error for="organization.tax_id" class="mt-2" />
                        </div>
                        <div class="flex flex-col flex-initial col-span-6 sm:col-span-3">
                            <x-jet-label for="address.address" value="{{ __('Organization Address') }}" />
                            <x-jet-input id="address.address" type="text" wire:model.defer="address.address" required />
                            <x-jet-input-error for="address.address" class="mt-2" />
                        </div>
                        <div class="flex flex-col flex-initial col-span-6 sm:col-span-3">
                            <x-jet-label for="address.unit" value="{{ __('Unit Number') }}" />
                            <x-jet-input id="address.unit" type="text" wire:model.defer="address.unit" />
                            <x-jet-input-error for="address.unit" class="mt-2" />
                        </div>
                        <div class="flex flex-col flex-initial col-span-6 sm:col-span-2">
                            <x-jet-label for="address.city" value="{{ __('City') }}" />
                            <x-jet-input id="address.city" type="text" wire:model.defer="address.city" required />
                            <x-jet-input-error for="address.city" class="mt-2" />
                        </div>
                        <div class="flex flex-col flex-initial col-span-6 sm:col-span-2">
                            <x-jet-label for="address.state" value="{{ __('State') }}" />
                            <x-jet-input id="address.state" type="text" wire:model.defer="address.state" required />
                            <x-jet-input-error for="address.state" class="mt-2" />
                        </div>
                        <div class="flex flex-col flex-initial col-span-6 sm:col-span-2">
                            <x-jet-label for="address.zipcode" value="{{ __('Zip Code') }}" />
                            <x-jet-input id="address.zipcode" type="text" wire:model.defer="address.zipcode" required />
                            <x-jet-input-error for="address.zipcode" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-button wire:loading.attr="disabled" wire:target="createOrganization" class="">
                                {{ __('Create Organization') }}
                            </x-jet-button>
                        </div>
                    </form>
                    <form class="w-1/3 shrink-0 flex flex-col gap-2 border border-orange-100 p-3 bg-orange-50 rounded" wire:submit.prevent="checkInviteCode">
                        <h3 class="text-lg text-orange-600 lighter">{{ __('Have an Invite Code?') }}</h3>
                        <p class="text-sm italic text-slate-800">{{ __('Enter your invite code to join an organization.') }}</p>
                        <div class="mb-3">
                            <x-jet-label for="invite" value="{{ __('Invitation Code') }}" />
                            <x-jet-input id="invite" type="text" />
                            <x-jet-input-error for="invite" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-button wire:loading.attr="disabled" wire:target="join" class="">
                                {{ __('Join Organization') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>