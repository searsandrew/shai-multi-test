<x-jet-form-section submit="updateInformation">
    <x-slot name="title">
        {{ __('Organization Information') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Update information for your organization. Most of the information you set here will be visible by Donors, so please be sure to use appropriate verbage and imagery.') }}</p>
        <small>{{ __('This section is for your organization as a whole, and not for individual comapaigns.') }}</small>
    </x-slot>

    <x-slot name="form">
        <div x-data="{logoName: null, logoPreview: null}" class="col-span-6 sm:col-span-4">
            <input type="file" class="hidden"
                        wire:model="logo"
                        x-ref="logo"
                        x-on:change="
                                logoName = $refs.logo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    logoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.logo.files[0]);
                        " />

            <x-jet-label for="logo" value="{{ __('Logo') }}" />

            <!-- Current Profile Logo -->
            <div class="mt-2" x-show="! logoPreview">
                <img src="{{ $organization->organization_logo_url ?? '' }}" alt="{{ $organization->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Logo Preview -->
            <div class="mt-2" x-show="logoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + logoPreview + '\');'">
                </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.logo.click()">
                {{ __('Select A New Logo') }}
            </x-jet-secondary-button>

            @if ($organization->profile_logo_path)
                <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteOrganizationLogo">
                    {{ __('Remove Logo') }}
                </x-jet-secondary-button>
            @endif

            <x-jet-input-error for="logo" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-span-4 sm:col-span-3">
            <x-jet-label for="organization.name" value="{{ __('Name') }}" />
            <x-jet-input id="organization.name" type="text" class="mt-1 block w-full" wire:model.defer="organization.name" autocomplete="organization.name" />
            <x-jet-input-error for="organization.name" class="mt-2" />
        </div>
        <div class="col-span-2 sm:col-span-1">
            <x-jet-label for="organization.tax_id" value="{{ __('Tax ID') }}" />
            <x-jet-input id="organization.tax_id" type="text" class="mt-1 block w-full" wire:model.defer="organization.tax_id" autocomplete="organization.tax_id" />
            <x-jet-input-error for="organization.tax_id" class="mt-2" />
        </div>

        <div class="flex flex-col flex-initial col-span-4 sm:col-span-3">
            <x-jet-label for="address.address" value="{{ __('Organization Address') }}" />
            <x-jet-input id="address.address" type="text" wire:model.defer="address.address" required />
            <x-jet-input-error for="address.address" class="mt-2" />
        </div>
        <div class="flex flex-col flex-initial col-span-2 sm:col-span-1">
            <x-jet-label for="address.unit" value="{{ __('Unit Number') }}" />
            <x-jet-input id="address.unit" type="text" wire:model.defer="address.unit" />
            <x-jet-input-error for="address.unit" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 grid grid-cols-3 gap-3">
            <div class="flex flex-col flex-initial">
                <x-jet-label for="address.city" value="{{ __('City') }}" />
                <x-jet-input id="address.city" type="text" wire:model.defer="address.city" required />
                <x-jet-input-error for="address.city" class="mt-2" />
            </div>
            <div class="flex flex-col flex-initial">
                <x-jet-label for="address.state" value="{{ __('State') }}" />
                <x-jet-input id="address.state" type="text" wire:model.defer="address.state" required />
                <x-jet-input-error for="address.state" class="mt-2" />
            </div>
            <div class="flex flex-col flex-initial">
                <x-jet-label for="address.zipcode" value="{{ __('Zip Code') }}" />
                <x-jet-input id="address.zipcode" type="text" wire:model.defer="address.zipcode" required />
                <x-jet-input-error for="address.zipcode" class="mt-2" />
            </div>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="{{ __('About Us') }}" />
            <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" rows="4" style="resize: none;" wire:model.defer="description"></textarea>
            <x-jet-input-error for="description" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="informationSaved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>