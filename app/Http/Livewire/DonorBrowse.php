<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Campaign;
use App\Models\Organization;
use App\Models\Recipients;

class DonorBrowse extends Component
{
    public Campaign $campaign;
    public Organization $organization;
    public mixed $search = false;

    public function mount(string $organizationSlug, string $campaignSlug)
    {
        $this->campaign = Campaign::where('slug', $campaignSlug)->first();
        $this->organization = Organization::where('slug', $organizationSlug)->first();
    }

    public function searchDonee($search)
    {
        return $this->campaign->recipients()->paginate(12);
    }

    public function render()
    {
        return view('livewire.donor-browse',[
            'donees' => $this->searchDonee($this->search)
        ]);
    }
}
