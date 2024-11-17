<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Project;
use App\Models\SmsBill;
use App\Models\WhatsAppBill;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.my-layouts.layout')]
class Dashboard extends Component
{
    public $totalUsers;
    public $totalProjects;
    public $totalOutstandingBill;
    public $tab = 1;
    public $userListLoaded = false;
    public $costOverviewLoaded = false;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalProjects = Project::count();

        // Calculate the total SMS bill for unpaid records
        $totalSmsBill = SmsBill::where('status', 'unpaid')->sum('total_sms_amount');
        $smsBill = $totalSmsBill ?: 0; // Will set to 0 if the sum is null or 0

        // Calculate the total WhatsApp bill for unpaid records
        $totalWhatsappBill = WhatsAppBill::where('status', 'unpaid')->sum('monthly_amount');
        $whatsappBill = $totalWhatsappBill ?: 0; // Will set to 0 if the sum is null or 0

        // Output the total of both bills
        // dump($smsBill + $whatsappBill);
        $this->totalOutstandingBill = $smsBill + $whatsappBill;
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
