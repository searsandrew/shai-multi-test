<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Recipients') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if(count($entries) > 0)
            @while($entries !== false)
                {{ $entry }}
            @endwhile
        @else
            {{ __('No entries were found.') }}
        @endif
    </div>
</div>