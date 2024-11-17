<?php

namespace App\Livewire;

use App\Models\Sensor;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;

class ChartFilter extends Component
{
    public $sensor_id;
    public $sensors;
    public $project_id;
    public $chartData = [];
    public $limit = 10; 

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    #[On('setLimit')]
    public function setLimit($isMobile)
    {
        $this->limit = $isMobile; // Update the limit dynamically
    }

    public function chartData()
    {
        $project = Project::find($this->project_id);

        $this->sensors = $project->latestSensors()->get();

        // Check if sensors are available
        if ($this->sensors->isNotEmpty()) {
            if ($this->sensor_id == null) {
                $this->sensor_id = $this->sensors->first()->sensor_id;
            }

            // $sensorReadings = ProjectSensor::where('sensor_id', $this->sensor_id)
            $sensorReadings = $project->projectSensor()
                ->where('sensor_id', $this->sensor_id)
                ->orderBy('created_at', 'desc')
                ->take($this->limit)
                ->get();

            // Prepare data for the chart
            $this->chartData['labels'] = $sensorReadings->pluck('created_at')->reverse()->map(function ($date) {
                return $date->format('g:i:s');
            })->values()->toArray();

            $this->chartData['data'] = $sensorReadings->pluck('value')->reverse()->values()->toArray();

            $this->chartData['sensorName'] = Sensor::find($this->sensor_id)->name;

            logger('Dispatching chartUpdated event', ['labels' => $this->chartData['labels'], 'data' => $this->chartData['data']]);
            $this->dispatch('chartUpdated', $this->chartData['labels'], $this->chartData['data']);
        } else {
            // Optionally, handle the case where no sensors are found
            $this->chartData['labels'] = [];
            $this->chartData['data'] = [];
        }
    }

    public function render()
    {
        $this->chartData();

        return view('livewire.chart-filter');
    }

    #[On('projectSelected')]
    public function projectSelected($projectId)
    {
        $this->project_id = $projectId;
    }
}
