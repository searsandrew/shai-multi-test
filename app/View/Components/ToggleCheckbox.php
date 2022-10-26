<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToggleCheckbox extends Component
{
    public $modelId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modelId = null)
    {
        $this->modelId = $modelId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toggle-checkbox');
    }
}
