<?php

namespace App\Livewire;

use App\Models\Sensor;
use App\Models\Project;
use Livewire\Component;
use App\Models\ProjectSensor;

class ChartFilter extends Component
{
    public $sensors;
    public $chartData = [];

    public function mount($project_id)
    {
        // Set default sensor or first one from the list
        $project = Project::where('id', $project_id)->first();
        $this->sensors = $project->latestSensors()->get();

        // Check if sensors are available
        if ($this->sensors->isNotEmpty()) {
            $sensor_id = $this->sensors->first()->sensor_id;
            $this->updateChart($sensor_id);

            $this->chartData['sensorName'] = Sensor::find($sensor_id)->name;

            // dump(Sensor::find($sensor_id)->name);
        } else {
            // Optionally, handle the case where no sensors are found
            $this->chartData['labels'] = [];
            $this->chartData['data'] = [];
        }
    }

    public function updateChart($sensor_id)
    {
        // Fetch the last 10 readings for the selected sensor
        $sensorReadings = ProjectSensor::where('sensor_id', $sensor_id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Prepare data for the chart
        $this->chartData['labels'] = $sensorReadings->pluck('created_at')->reverse()->map(function ($date) {
            return $date->format('g:i:s');
        })->values()->toArray();

        $this->chartData['data'] = $sensorReadings->pluck('value')->reverse()->values()->toArray();

        // Add the sensor name to the chartData
        // $this->chartData['sensorName'] = $sensor->name;
        // logger('Dispatching chartUpdated event', ['labels' => $this->chartData['labels'], 'data' => $this->chartData['data']]);
        $this->dispatch('chartUpdated', $this->chartData['labels'], $this->chartData['data']);
    }

    public function render()
    {
        return view('livewire.chart-filter');
    }
}
