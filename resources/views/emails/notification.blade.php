<x-mail::message>
# Hi {{ $donation->donor->name}},

Thank your for committing to donate to {{ $donation->recipient->campaign->name }}!

This email is a reminder for donation #{{ $donation->uuid }}

Your recipients name is: {{ $donation->recipient->name }}

Wishlist: {{ $donation->recipient->description }}

If you have any questions, please feel to contact us with questions.

Thanks,<br>
{{ $donation->recipient->campaign->organization->name }}
</x-mail::message>
