<?php

namespace App\Livewire\Schedules;

use Livewire\Component;
use App\Models\Schedule;

class ScheduleStatus extends Component
{
    public $scheduleId;
    public $status;

    // protected $listeners = ['refreshStatus' => '$refresh'];

    public function mount($scheduleId, $status)
    {
        $this->scheduleId = $scheduleId;
        $this->status = $status;
    }

    public function updateStatus()
    {
        // Fetch the schedule status from the database.
        $schedule = Schedule::find($this->scheduleId);
        $this->status = $schedule ? $schedule->status : null;
    }
    
    public function render()
    {
        return view('livewire.schedules.schedule-status');
    }
}
