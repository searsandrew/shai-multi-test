<x-app-layout>
    @php
        $organization = \App\Models\Organization::where('slug', $organization)->first();
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organization Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <livewire:organization.update-information-form :organization="$organization" />
            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>