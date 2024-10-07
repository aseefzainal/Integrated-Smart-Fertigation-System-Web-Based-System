<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.my-layouts.layout')]
class UserList extends Component
{
    public $query;

    public function render()
    {
        if($this->query) {
            $users = User::where('name', 'like', '%' . $this->query . '%');
        } else {
            $users = User::where('role', 'user');
        }
        return view('livewire.user-list', ['users' => $users->paginate(10)]);
    }

    public function filter() {}
}