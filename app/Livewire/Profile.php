<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.my-layouts.layout')]
class Profile extends Component
{
    public $user;
    public $tab = 1;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function updatedTab($value)
    {
        $this->tab = (int) $value; // Cast the tab value to integer
    }

    public function render()
    {
        return view('livewire.profile', [
            'projects' => $this->user->projects
        ]);
    }
}
