<?php

namespace App\Livewire\Sensors;

use App\Models\ProjectSensor;
use Livewire\Component;

class LatestData extends Component
{
    public $sensorId;
    public $value;
    public $unit;

    public function mount($sensorId, $value, $unit)
    {
        $this->sensorId = $sensorId;
        $this->value = $value;
        $this->unit = $unit;
    }

    public function getLatestDataSensor()
    {
        // $this->sensors = $this->project->latestSensors()->get();
        $sensor = ProjectSensor::where('sensor_id', $this->sensorId)->latest()->first();
        $this->value = $sensor->value;
        $this->unit = $sensor->sensor->unit;
    }

    public function render()
    {
        return view('livewire.sensors.latest-data');
    }
}
