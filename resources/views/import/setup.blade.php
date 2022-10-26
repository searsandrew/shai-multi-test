<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Import Columns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form-section submit="updateInformation">
                <x-slot name="title">
                    {{ __('Organization Information') }}
                </x-slot>
            
                <x-slot name="description">
                    <p>{{ __('Update information for your organization. Most of the information you set here will be visible by Donors, so please be sure to use appropriate verbage and imagery.') }}</p>
                    <small>{{ __('This section is for your organization as a whole, and not for individual comapaigns.') }}</small>
                </x-slot>
            
                <x-slot name="form">
                    <form method="POST" action="{{ route('recipient.column') }}" class="col-span-6 content-center">
                        @csrf
                        <input type="hidden" name="path" value="{{ $path }}" />
                        @forelse($firstRow as $key => $column)
                            <div class="grid grid-cols-2 gap-3 mb-2">
                                <span class="items-center">{{ $column }}</span>
                                <select name="{{ $key }}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="ref_id">{{ __('External Referance Identifier') }}</option>
                                    <option value="internal_ref_slug">{{ __('Internal Referance Identifier (Optional)') }}</option>
                                    <option value="family">{{ __('Family Name (Optional)') }}</option>
                                    <option value="name">{{ __('Recipient Name') }}</option>
                                    <option value="description">{{ __('Description (Optional)') }}</option>
                                    <option value="tag">{{ __('Tag') }}</option>
                                </select>
                            </div>
                        @empty
                            {{ __('No columns were found. Check your line endings or file encoding. Ensure you are using a valid CSV file.') }}
                        @endforelse

                        <div class="flex items-center justify-end px-4 mt-3 text-right">
                            <x-jet-button type="submit">
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>
                    </x-slot>
                </form>
            </x-form-section>
        </div>
    </div>
</x-app-layout>

