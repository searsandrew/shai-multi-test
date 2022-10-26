<?php

namespace App\Http\Livewire\Campaign;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Campaign;

use Auth;

class Form extends Component
{
    public Campaign $campaign;

    protected $listeners = ['saveForm' => 'saveCampaign'];

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

    public function mount($campaign)
    {
        $this->campaign = $campaign;
        $this->campaign->started_at = $campaign->started_at->toString();
    }

    public function saveCampaign()
    {
        $this->validate();

        if($this->campaign->organization()->count() == 0)
        {
            $this->campaign->organization()->associate(Auth::user()->current_organization);
        }

        $this->campaign->save();

        dd($this->campaign);

        $this->emitUp('campaignSaved');
    }

    public function render()
    {
        return view('livewire.campaign.form');
    }
}
