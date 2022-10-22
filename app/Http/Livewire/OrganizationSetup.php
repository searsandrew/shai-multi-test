<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Address;
use App\Models\Organization;

use Auth;

class OrganizationSetup extends Component
{
    public Address $address;
    public Organization $organization;

    protected $rules = [
        'organization.name' => 'required|string',
        'organization.tax_id' => 'nullable|string',
        'address.address' => 'required|string',
        'address.unit' => 'nullable|string',
        'address.city' => 'required|string',
        'address.state' => 'required|string',
        'address.zipcode' => 'required|string',
        'address.phone' => 'nullable|string',
    ];

    public function mount()
    {
        $this->address = new Address();
        $this->organization = new Organization();
    }

    public function createOrganization()
    {
        $this->validate();

        $this->organization->save();
        $this->organization->users()->attach(Auth::user());

        $this->address->addressable_id = $this->organization->id;
        $this->address->addressable_type = 'App\Models\Organization';
        $this->address->save();

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.organization-setup');
    }
}
