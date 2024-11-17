<?php

namespace App\Livewire\Dashboard;

use App\Models\SmsBill;
use App\Models\User;
use Livewire\Component;

class CostOverview extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.dashboard.cost-overview');
    }
}
