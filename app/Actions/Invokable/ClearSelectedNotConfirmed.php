<?php

namespace App\Actions\Invokable;

use Illuminate\Support\Facades\Mail;
use App\Models\Donation;

class ClearSelectedNotConfirmed
{
    public function __invoke()
    {
        $time = Carbon::now('15 minutes ago')->toDateTimeString();
        $donations = Donation::where('status', 'selected')->whereTime('updated_at', '>=', $time)->get();

        foreach($donations as $donation)
        {
            $donation->delete();
        }
    }
}
