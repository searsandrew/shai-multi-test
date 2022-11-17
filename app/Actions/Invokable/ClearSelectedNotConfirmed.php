<?php

namespace App\Actions\Invokable;

use Illuminate\Support\Facades\Mail;
use App\Models\Donation;

use Carbon\Carbon;

class ClearSelectedNotConfirmed
{
    public function __invoke()
    {
        $time = Carbon::now()->subMinutes(15)->toDateTimeString();
        return Donation::where('status', 'selected')->whereTime('selected_at', '<=', $time)->delete();
    }
}
