<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ScheduleFilter extends Component
{
    public $schedules;
    public $inputs;
    public $project_id;

    public function mount($project_id)
    {
        $this->project_id = $project_id;
        $this->updateSchedule($project_id);
    }

    public function render()
    {
        return view('livewire.schedule-filter');
    }

    public function updateSchedule($project_id, $input_id = null)
    {
        // Fetch the project and its inputs
        $project = Project::findOrFail($project_id);
        $this->inputs = $project->inputs()->where('type', 'auto')->get();

        // Always fetch the full schedule list from the database
        if ($input_id != null) {
            // Filter schedules based on the selected input
            $this->schedules = $project->schedules()->whereHas('projectInput', function ($query) use ($input_id) {
                $query->where('input_id', $input_id);
            })->get();
        } else {
            // If no specific input is selected, show all schedules
            $this->schedules = $project->schedules()->get();
        }
    }
}
