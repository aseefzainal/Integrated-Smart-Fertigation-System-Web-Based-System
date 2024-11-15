<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.my-layouts.layout')]
class Dashboard extends Component
{
    public $totalUsers;
    public $totalProjects;
    public $tab = 1;
    public $userListLoaded = false;
    public $costOverviewLoaded = false;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalProjects = Project::count();
    }

    public function loadUserList()
    {
        $this->userListLoaded = true;
        $this->dispatch('flowbitInit');
    }

    public function loadCostOverview()
    {
        $this->costOverviewLoaded = true;
        $this->dispatch('costChart');
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}