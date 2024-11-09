<?php

namespace App\Livewire\Inputs;

use Livewire\Component;
use App\Models\ProjectInput;

class SwitchButton extends Component
{
    public $inputId;
    public $status;

    public function mount($inputId, $status)
    {
        $this->inputId = $inputId;
        $this->status = $status;
    }

    public function openModal()
    {
        $this->dispatch('showWarningModal', inputId: $this->inputId);
    }

    public function updateInputStatus()
    {
        $input = ProjectInput::find($this->inputId);
        $this->status = $input ? $input->status : null;
    }

    public function render()
    {
        return view('livewire.inputs.switch-button');
    }
}
