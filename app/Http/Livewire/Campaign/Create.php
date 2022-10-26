<?php

namespace App\Http\Livewire\Campaign;

use Livewire\Component;

use App\Models\Campaign;

use Auth;

class Create extends Component
{
    public Campaign $campaign;

    protected $rules = [
        'campaign.name' => 'required|string',
        'campaign.started_at' => 'required|string',
        'campaign.ended_at' => 'required|string',
        'campaign.toggle_image' => 'nullable|boolean',
        'campaign.toggle_family' => 'nullable|boolean',
        'campaign.toggle_privacy' => 'nullable|boolean',
        'campaign.toggle_transaction_email' => 'nullable|boolean',
        'campaign.toggle_instruction_email' => 'nullable|boolean',
        'campaign.toggle_reminder_email' => 'nullable|boolean',
    ];

    public function mount()
    {
        $this->campaign = new Campaign([
            'toggle_image' => false,
            'toggle_family' => false,
            'toggle_privacy' => false,
            'toggle_transaction_email' => false,
            'toggle_instruction_email' => false,
            'toggle_reminder_email' => false,
        ]);
    }

    public function saveCampaign()
    {
        $this->validate();
        $this->campaign->organization()->associate(Auth::user()->current_organization);
        $this->campaign->save();

        $this->emit('campaignSaved');
    }

    public function render()
    {
        return view('livewire.campaign.create');
    }
}
