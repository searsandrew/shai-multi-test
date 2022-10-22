<x-mail::message>
# I'm using Shai to collect donations

I'd like you to join my organization, {{ $invite->organization->name }}, and help me coordinate and manage our donations.

Be sure to accept this link within 48-hours, or else the invite code will expire.

<x-mail::button :url="route('invite.code', $invite->uuid)">
Accept Invitation
</x-mail::button>

You can also register for an account and enter the following invite code: <code>{{ $invite->uuid }}</code>

Thanks,<br>
{{ Auth::user()->name() }}
</x-mail::message>
