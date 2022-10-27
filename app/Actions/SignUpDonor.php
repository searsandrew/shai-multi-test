<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

use App\Models\Donor;

class SignUpDonor
{
    use AsAction;

    public function handle($request)
    {
        $donor = Donor::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->name,
        ]);

        $request->session()->put('donor', $donor->uuid);
    }

    public function asController(Request $request)
    {
        $this->handle($request);
        
        return back();
    }
}
