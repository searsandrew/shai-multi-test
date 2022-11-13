<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Routing\Router;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Recipient;

use Carbon\Carbon;

class UpdateRecipientFromQR
{
    use AsAction;

    public function handle(Recipient $recipient, Donor $donor)
    {
        $test = Donation::create([
            'donor_id' => $donor->id,
            'recipient_id' => $recipient->id,
            'selected_at' => Carbon::now()->toDateTimeString()
        ]);
    }

    public function asController(string $uuid, Request $request)
    {
        $recipient = Recipient::where('uuid', $uuid)->first();
        $donor = Donor::where('uuid', $request->session()->get('donor'))->first();

        if(!is_null($recipient->donation))
        {
            return redirect(route('donor.browse', [$recipient->campaign->organization->slug, $recipient->campaign->slug]))->with('notice', 1001);
        }
        
        try {
            $this->handle($recipient, $donor);
        } catch (\Throwable $th) {
            return redirect(route('donor.browse', [$recipient->campaign->organization->slug, $recipient->campaign->slug]))->with('notice', 1003);
        }

        return redirect(route('donor.browse', [$recipient->campaign->organization->slug, $recipient->campaign->slug]))->with('notice', 1002);
    }
}
