<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class InputFilter extends Component
{
    public $inputs;
    public $project_id;
    public $controlType = 'manual';

    public function mount($project_id)
    {
        $this->project_id = $project_id;
        $this->toggleControlType();
    }

    public function render()
    {
        return view('livewire.input-filter', [
            'controlText' => $this->controlType === 'auto' ? 'Switch to Manual Control' : 'Switch to Auto Control'
        ]);
    }

    public function toggleControlType()
    {
        // Toggle the control type
        $this->controlType = $this->controlType === 'auto' ? 'manual' : 'auto';

        // Fetch inputs based on the selected control type
        $this->inputs = Project::findOrFail($this->project_id)
            ->inputs()
            ->where('type', $this->controlType)
            ->get();
    }
}
