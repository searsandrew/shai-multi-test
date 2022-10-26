<?php

namespace App\Http\Livewire\Campaign;

use Livewire\Component;

use App\Models\Campaign;

class Show extends Component
{
    public Campaign $campaign;

    public function render()
    {
        return view('livewire.campaign.show');
    }
}
