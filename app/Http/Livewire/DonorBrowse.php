<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Campaign;
use App\Models\Organization;
use App\Models\Recipients;

class DonorBrowse extends Component
{
    use WithPagination;

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
        return $this->campaign->availableRecipients();
    }

    public function render()
    {
        return view('livewire.donor-browse',[
            'donees' => $this->searchDonee($this->search)
        ]);
    }
}
