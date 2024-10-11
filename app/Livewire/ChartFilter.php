<?php

namespace App\Livewire;

use App\Models\Sensor;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProjectSensor;

class ChartFilter extends Component
{
    public $sensor_id;
    public $project_id;
    public $chartData = [];

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    public function render()
    {
        // Set default sensor or first one from the list
        $project = Project::where('id', $this->project_id)->first();

        $sensors = $project->latestSensors()->get();

        // Check if sensors are available
        if ($sensors->isNotEmpty()) {
            if ($this->sensor_id == null) {
                $this->sensor_id = $sensors->first()->sensor_id;
            }

            // $sensorReadings = ProjectSensor::where('sensor_id', $this->sensor_id)
            $sensorReadings = $project->projectSensor()
                ->where('sensor_id', $this->sensor_id)
                ->orderBy('created_at', 'desc')
                ->take(10)
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

        return view('livewire.chart-filter', [
            'sensors' => $sensors
        ]);
    }

    #[On('projectSelected')]
    public function projectSelected($projectId)
    {
        $this->project_id = $projectId;
    }
}
