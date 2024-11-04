<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\ProjectInput;

class ScheduleService
{
    public function updateInputStatus()
    {
        $currentDateTime = Carbon::now();

        // Fetch all schedules for today
        $schedules = Schedule::where('status', 0)->whereDate('date', '=', $currentDateTime->toDateString())->get();

        foreach ($schedules as $schedule) {
            // Define schedule start and end times
            $scheduleStart = Carbon::parse($schedule->date->format('Y-m-d') . ' ' . $schedule->time->format('H:i'));
            // $scheduleEnd = $scheduleStart->copy()->addMinutes($schedule->duration);

            // if ($currentDateTime->lt($scheduleStart)) {
            //     // Schedule is pending
            //     $schedule->status = 0; // Pending
            // } elseif ($currentDateTime->between($scheduleStart, $scheduleEnd)) {
            //     // Schedule is processing
            //     $schedule->status = 1; // Processing
            //     $this->updateProjectInputStatus($schedule->project_input_id, true);
            // } elseif ($currentDateTime->gt($scheduleEnd)) {
            //     if ($schedule->status === 1) {
            //         // Schedule was processing and has now completed
            //         $schedule->status = 3; // Completed
            //         $this->updateProjectInputStatus($schedule->project_input_id, false);
            //     } else {
            //         // Schedule time has passed without processing, mark as overdue
            //         $schedule->status = 5; // Overdue
            //     }
            // }

            if ($currentDateTime->format('Y-m-d H:i') === $scheduleStart->format('Y-m-d H:i')) {
                // Schedule is processing
                $schedule->status = 1; // Processing
                $this->updateProjectInputStatus($schedule->id, $schedule->project_input_id, true);
            } else {
                $schedule->status = 3; // Overdue
            }
            // elseif ($currentDateTime->gt($scheduleEnd)) {
            //     if ($schedule->status === 1) {
            //         // Schedule was processing and has now completed
            //         $schedule->status = 2; // Completed
            //         $this->updateProjectInputStatus($schedule->project_input_id, false);
            //     } else {
            //         // Schedule time has passed without processing, mark as overdue
            //         $schedule->status = 5; // Overdue
            //     }
            // }

            // Save the updated schedule status
            $schedule->save();
        }
    }

    private function updateProjectInputStatus(int $scheduleId, int $projectInputId, bool $status)
    {
        $projectInput = ProjectInput::find($projectInputId);

        if ($projectInput) {
            $projectInput->status = $status;
            $projectInput->save();

            // Resolve MQTTPublishService instance and call the method
            $mqttService = app(MQTTPublishService::class);
            $mqttService->publishInputStatus($projectInput, $scheduleId);
        }
    }
}
