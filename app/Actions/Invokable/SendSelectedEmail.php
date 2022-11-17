<?php

namespace App\Actions\Invokable;

use App\Models\Donation;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonorNotified;

class SendSelectedEmail
{
    public function __invoke()
    {
        $donations = Donation::where('status', 'confirmed')->get();

        foreach($donations as $donation)
        {
            Mail::to($donation->donor->email)->send(new DonorNotified($donation));
            // return (new DonorNotified($donation))->render();
        }
    }
}