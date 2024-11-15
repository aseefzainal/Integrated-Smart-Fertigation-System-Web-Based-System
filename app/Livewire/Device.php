<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
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
    }

    public function render()
    {
        if (!$this->project) {
            return view('livewire.device', ['projects' => $this->user->projects]);
        }

        return view('livewire.device', [
            'projects' => $this->user->projects,
            'project_id' => $this->project->id,
        ]);
    }

    public function sendSms()
    {
        $smsMessage = "Alert\n" .
            "Project:" . $this->project->name . "\n" .
            "Sensor: " . '$sensorNotification->sensor->name' . "\n" .
            "Threshold Value: " . '$sensorNotification->value' . '$sensorNotification->sensor->unit' . "\n" .
            "Current Value: " . '$sensor["value"]' . '$sensorNotification->sensor->unit' . "\n\n" .
            "Please take the necessary action!";

        $this->notificationService->sendSms($this->project->user, $smsMessage);

        // $threshold = Carbon::now()->subMinutes(5); // Set your threshold, e.g., 5 minutes
        // $projects = Project::where('last_active_at', '<', $threshold)
        //                     ->orWhereNull('last_active_at')
        //                     ->get();

        // foreach ($projects as $project) {
        //     $project->update(['status' => false]);
        //     $this->info("Project ID {$project->id} marked as OFF due to inactivity.");
        // }

    }

    public function updateProjectId($project_id)
    {
        $this->project = $this->user->projects->where('id', $project_id)->first();

        $this->dispatch('projectSelected', projectId: $project_id);
    }
}
