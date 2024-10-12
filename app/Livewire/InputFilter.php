<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\ProjectInput;
use Livewire\Component;
use Livewire\Attributes\On;

class InputFilter extends Component
{
    public $project_id;
    public $inputId;
    public $originalStatus;
    public $controlType = 'auto';

    // protected $listeners = ['openModal' => 'openModal'];

    #[On('openModal')]
    public function openModal($inputId)
    {
        $this->inputId = $inputId;
        $input = ProjectInput::find($this->inputId);
        $this->originalStatus = $input->status;
        $this->dispatch('showModal');
    }
    
    public function toggleStatus()
    {
        sleep(5);

        $input = ProjectInput::find($this->inputId);
        $input->status = !$input->status;
        $input->save();
        
        // Close modal after confirming
        $this->dispatch('hideModal');

        session()->flash('success', $input->custom_name . ' has successfully ' . ($input->status == 1 ? 'turned on.' : 'turned off.'));
    }

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
