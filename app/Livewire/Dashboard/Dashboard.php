<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.my-layouts.layout')]
class Dashboard extends Component
{
    public $tab = 4;
    
    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}