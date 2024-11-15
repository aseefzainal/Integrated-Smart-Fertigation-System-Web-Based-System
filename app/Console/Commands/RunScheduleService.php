<?php

namespace App\Console\Commands;

use run;
use Carbon\Carbon;
use App\Models\Project;
use App\Services\Notifications;
use Illuminate\Console\Command;
use App\Services\ScheduleService;

class RunScheduleService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:run-schedule-service';
    protected $signature = 'schedule:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Schedule Service';
    protected $scheduleService;
    protected $notification;

    /**
     * Execute the console command.
     */

     public function __construct(ScheduleService $scheduleService, Notifications $notification)
    {
        parent::__construct();
        $this->scheduleService = $scheduleService;
        $this->notification = $notification;
    }
    
    public function handle()
    {
        $this->scheduleService->updateInputStatus();
        $this->notification->ResetNotification();
        
        $threshold = Carbon::now()->subMinutes(5); // Set your threshold, e.g., 5 minutes
        $projects = Project::where('last_active_at', '<', $threshold)
                            ->orWhereNull('last_active_at')
                            ->get();

        foreach ($projects as $project) {
            $project->update(['status' => false]);
            $this->info("Project ID {$project->id} marked as OFF due to inactivity.");
        }

        return Command::SUCCESS;
    }
}
