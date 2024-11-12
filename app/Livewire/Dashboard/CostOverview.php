<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class CostOverview extends Component
{
    public function render()
    {
        return view('livewire.dashboard.cost-overview', [
            // 'users' => User::latest()->limit(8)->get()
            'users' => User::all()
        ]);
    }
}
