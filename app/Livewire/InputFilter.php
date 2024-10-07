<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class InputFilter extends Component
{
    public $project_id;
    public $controlType = 'auto';

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    public function render()
    {
        $inputs = Project::findOrFail($this->project_id)
            ->inputs()
            ->where('type', $this->controlType)
            ->get();

        return view('livewire.input-filter', [
            'controlText' => $this->controlType === 'auto' ? 'Switch to Manual Control' : 'Switch to Auto Control',
            'inputs' => $inputs
        ]);
    }

    public function toggleControlType()
    {
        $this->controlType = $this->controlType === 'auto' ? 'manual' : 'auto';
    }

    #[On('projectSelected')]
    public function projectSelected($projectId)
    {
        $this->project_id = $projectId;
    }
}
