<?php

namespace App\Http\Livewire\Organization;

use Livewire\Component;

class Invite extends Component
{
    public bool $inviteToggle = false;

    public function inviteModal()
    {
        
    }

    public function render()
    {
        return view('livewire.organization.invite');
    }
}
