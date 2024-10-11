<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;

#[Layout('components.my-layouts.layout')]
class UserList extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $query;

    public function render()
    {
        $users = User::where('role', 'user');

        if($this->query) {
            $users = $users->where('name', 'like', '%' . $this->query . '%');
        }

        return view('livewire.user-list', ['users' => $users->paginate(10)]);
    }

    // lifecycle Hook livewire updating + query (nama variable di atas)
    public function updatingQuery() {
        $this->resetPage();
    }
}