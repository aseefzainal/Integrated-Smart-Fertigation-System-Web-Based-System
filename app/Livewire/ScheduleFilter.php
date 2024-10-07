<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;

class ScheduleFilter extends Component
{
    public $input_id;
    public $project_id;

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    public function render()
    {
        $project = Project::findOrFail($this->project_id);
        $inputs = $project->inputs()->where('type', 'auto')->get();

        // dump($inputs);

        // Always fetch the full schedule list from the database
        if ($this->input_id != null) {
            // Filter schedules based on the selected input
            $schedules = $project->schedules()
                ->whereHas('projectInput', function ($query) {
                    $query->where('input_id', $this->input_id);
                });
        } else {
            // If no specific input is selected, show all schedules
            $schedules = $project->schedules();
        }

        return view('livewire.schedule-filter', [
            'inputs' => $inputs,
            'schedules' => $schedules->paginate(5)
        ]);
    }

    public function updateSchedule($input_id = null)
    {
        $this->input_id = $input_id;
    }

    #[On('projectSelected')]
    public function projectSelected($projectId)
    {
        $this->project_id = $projectId;
    }
}
