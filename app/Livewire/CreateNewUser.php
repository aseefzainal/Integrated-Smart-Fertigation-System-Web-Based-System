<?php

namespace App\Livewire;

use App\Models\Input;
use App\Models\Sensor;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.my-layouts.layout')]
class CreateNewUser extends Component
{
    public $step = 1;

    public function render()
    {
        return view('livewire.create-new-user', [
            'inputs' => Input::all(),
            'sensors' => Sensor::all()
        ]);
    }

    public function incrementStep()
    {
        $this->step++;
    }

    public function decrementStep()
    {
        $this->step--;
    }
}
