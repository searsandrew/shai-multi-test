<div>
    <div class="p-4 mx-2 rounded bg-blue-50 border border-blue-100">
        @switch(session('notice'))
            @case(1001)
                {{ __('Unfortinuately this Recipient has already been selected by another user. If you\'ve scanned a label in person, please let a volunteer know. You can check again in about 15 minutes in case the donor has changed their mind.') }}
                @break

            @case(1002)
                {{ __('Recipient has been sucessfully added to your gift list. Please be sure to confirm your gift list in the next 15 minutes to finalize your selections.') }}
                @break

            @case(1003)
                {{ __('An attempt to create a donation record for you has failed. You have not claimed the recipient. Please contact an administrator for assistance.') }}
                @break

            @default
        @endswitch
    </div>

    <div class="divide-y" wire:poll>
        @forelse($donees as $donee)
            <a href="{{ route('recipient.qr', $donee->uuid) }}" class="flex flex-col bg-white hover:bg-orange-50 px-3 py-1">
                <h3 class="text-lg lighter">{{ $donee->name }}</h3>
                <p class="text-sm italic text-slate-600">{{ $donee->description }}</p>
                <span class="flex flex-row flex-wrap gap-1 striped">
                    @foreach($donee->tags as $tag)
                        <span class="bg-slate-200 text-slate-600 text-xs text-semibold capitalize rounded-lg px-2">
                            {{ $tag->type }}: {{ $tag->name }}
                        </span>
                    @endforeach
                </span>
            </a>
        @empty
            {{ __('There are no remaining recipients in this campaign currently.') }}
        @endforelse
    </div>
</div>
