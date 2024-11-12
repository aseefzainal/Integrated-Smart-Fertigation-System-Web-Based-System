<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

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

        return view('livewire.dashboard.user-list', ['users' => $users->paginate(10)]);
    }

    // lifecycle Hook livewire updating + query (nama variable di atas)
    public function updatingQuery() {
        $this->resetPage();
    }

    public function delete($userId)
    {
        $item = User::findOrFail($userId);
        $item->delete();

        // Emit an event or show a success message (optional)
        session()->flash('success', 'User deleted successfully!');
    }
}