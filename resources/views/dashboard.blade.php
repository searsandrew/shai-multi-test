<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->current_organization->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-3 gap-3 sm:divide-x px-6 py-3">
                    <div class="col-span-3 sm:col-span-1 sm:pr-3">
                        <h2 class="text-lg lighter text-slate-600">{{ __('Recipeients') }}
                    </div>
                    <div class="col-span-3 sm:col-span-1 sm:px-3">
                        <h2 class="text-lg lighter text-slate-600">{{ __('Donors') }}
                    </div>
                    <div class="col-span-3 sm:col-span-1 sm:pl-3">
                        <h2 class="text-lg lighter text-slate-600">{{ __('Campaigns') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
