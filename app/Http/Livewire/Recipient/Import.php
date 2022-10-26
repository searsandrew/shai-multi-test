<?php

namespace App\Http\Livewire\Recipient;
use Illuminate\Http\Request;

use Livewire\Component;

class Import extends Component
{
    public array $entries;

    public function mount(Request $request)
    {
        $filename = $request->file('file');
        $this->entries = fgetcsv(fopen($filename->getRealPath(), "r"), 10000, ",");
    }

    public function render()
    {
        return view('livewire.recipient.import');
    }
}
