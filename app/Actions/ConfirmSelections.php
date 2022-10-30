<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

use App\Models\Donor;

class ConfirmSelections
{
    use AsAction;

    public function handle(Request $request)
    {
        $requested = $request->session()->get('donor');
        $donor = Donor::where('uuid', $requested)->first();

        $donor->donations()->where('status', 'selected')->update([
            'status' => 'confirmed'
        ]);

        return back();
    }
}
