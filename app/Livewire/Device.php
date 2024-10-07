<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.my-layouts.layout')]
class Device extends Component
{
    public $user;
    public $project;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->project = $this->user->projects->first();

        // dd($this->user->projects->first());
    }

    public function render()
    {
        if (!$this->project) {
            return view('livewire.device', ['projects' => $this->user->projects]);
        }

        $sensors = $this->project->latestSensors()->get();

        return view('livewire.device', [
            'projects' => $this->user->projects,
            'project_id' => $this->project->id,
            'sensors' => $sensors,
        ]);
    }

    public function updateProjectId($project_id) {
        $this->project = $this->user->projects->where('id', $project_id)->first();

        $this->dispatch('projectSelected', projectId: $project_id);

        // dump($this->project);
    }
}
