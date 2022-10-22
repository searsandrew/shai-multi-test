<?php

namespace App\Http\Livewire\Organization;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Address;
use App\Models\Organization;

class UpdateInformationForm extends Component
{
    use WithFileUploads;

    public Address $address;
    public Organization $organization;
    public string $description, $logo;

    protected $rules = [
        'organization.name' => 'required|string',
        'organization.tax_id' => 'nullable|string',
        'address.address' => 'required|string',
        'address.unit' => 'nullable|string',
        'address.city' => 'required|string',
        'address.state' => 'required|string',
        'address.zipcode' => 'required|string',
        'address.phone' => 'nullable|string',
        'description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->logo = $this->organization->getOrganizationLogoUrlAttribute();
        $this->address = $this->organization->address;
        $this->description = $this->organization->getMeta('description') ?? '';
    }

    public function updateInformation()
    {
        $this->validate();

        if($this->organization->organization_logo_url != $this->logo)
        {
            $this->validate([
                'logo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            ]);
            $obj = $this->logo->storePublicly('organization-logos');
            $this->organization->organization_logo_path = $obj;
        }
        
        $this->organization->save();
        $this->organization->setMeta('description', $this->description);

        $this->address->save();

        $this->emit('informationSaved');
    }

    public function render()
    {
        return view('livewire.organization.update-information-form');
    }
}
