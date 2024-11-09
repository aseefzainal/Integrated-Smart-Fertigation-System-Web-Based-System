<?php

namespace App\Livewire\Sensors;

use App\Models\Project;
use App\Models\Setting;
use Livewire\Component;
use App\Models\LimitSensor;
use App\Models\UserSetting;
use Livewire\Attributes\Validate;
use App\Models\SensorNotification;

class DataSensor extends Component
{
    public $project;
    public $sensors;

    public $tab = 1;
    public $showSensorModal = false;
    public $selectedSensor;
    public $showSelectBox = false;

    public $sensorNotificationValues = [];
    public $limitSensorValues = [];

    public $sensorNotifications;
    public $limitSensors;

    #[Validate('required|numeric|min:0')]
    public $limitSensor;

    #[Validate('required|numeric|min:5|max:10')]
    public $countdown;

    public function messages()
    {
        return [
            'limitSensorValues.*.required' => 'Please enter a value for all limit sensors.',
            'limitSensorValues.*.integer' => 'The limit sensor value must be a valid number.',
            'limitSensorValues.*.min' => 'The limit sensor value must be at least 0.',

            'sensorNotificationValues.*.required' => 'Please enter a value for all sensor notification thresholds.',
            'sensorNotificationValues.*.integer' => 'The sensor notification value must be a valid number.',
            'sensorNotificationValues.*.min' => 'The sensor notification value must be at least 0.',
        ];
    }

    public function updated($propertyName)
    {
        // Perform validation for the updated field only
        $this->validateOnly($propertyName, [
            'limitSensorValues.*' => 'required|integer|min:0',
            'sensorNotificationValues.*' => 'required|integer|min:0',
        ]);
    }

    public function removeSensor($sensorId)
    {
        $item = $this->project->sensorNotifications->find($sensorId);

        if ($item) {
            $item->delete();
            $this->sensorNotifications = $this->sensorNotifications->where('id', '!=', $sensorId); // Filter out the deleted item
        }
    }

    public function addSensor()
    {
        if ($this->selectedSensor != null) {
            // Create a new instance of the model
            $item = SensorNotification::create([
                'user_id' => $this->project->user->id,
                'project_id' => $this->project->id,
                'sensor_id' => $this->selectedSensor,
                'value' => 0
            ]);
            // Add to the collection
            $this->sensorNotifications->push($item);

            $this->selectedSensor = null;
            $this->showSelectBox = false;
        }
    }

    public function save()
    {
        foreach ($this->sensorNotificationValues as $sensorId => $value) {
            SensorNotification::updateOrCreate(
                ['id' => $sensorId],  // This is the condition to find the existing record
                [
                    'value' => $value,
                ]
            );
        }

        foreach ($this->limitSensorValues as $sensorId => $value) {
            // Use updateOrCreate to update existing data or create new data
            LimitSensor::updateOrCreate(
                ['id' => $sensorId],
                [
                    'value' => $value,
                ]
            );
        }

        // Retrieve the 'countdown' setting by name
        $countdownSetting = Setting::where('name', 'countdown')->first();

        if ($countdownSetting) {
            // Update the pivot value for only the countdown setting
            $this->project->user->settings()->updateExistingPivot($countdownSetting->id, ['value' => $this->countdown]);
        }

        $this->resetInputFields();
        session()->flash('success', 'Sensor setting updated successfully!');
        $this->showSensorModal = false;
    }

    public function mount($project_id)
    {
        $this->project = Project::find($project_id);
    }

    public function getLatestDataSensor()
    {
        $this->sensors = $this->project->latestSensors()->get();
    }

    public function render()
    {
        $this->limitSensors = $this->project->limitSensors;

        if (!$this->limitSensors->isEmpty()) {
            foreach ($this->limitSensors as $sensor) {
                if (!isset($this->limitSensorValues[$sensor->id])) {
                    $this->limitSensorValues[$sensor->id] = $sensor->value;  // Only load if not already set
                }
            }
        }

        // dd($this->limitSensors);

        $this->sensorNotifications = $this->project->sensorNotifications;

        if (!$this->sensorNotifications->isEmpty()) {

            foreach ($this->sensorNotifications as $sensor) {
                if (!isset($this->sensorNotificationValues[$sensor->id])) {
                    $this->sensorNotificationValues[$sensor->id] = $sensor->value;  // Only load if not already set
                }
            }
        }

        if (!isset($this->countdown)) {
            // $this->countdown = $sensorNotifications[0]->countdown;

            $setting = Setting::where('name', 'countdown')->first();

            // $user->settings()->updateExistingPivot($setting->id, ['value' => $this->countdown]);
            $countdown = UserSetting::where('user_id', $this->project->user->id)->where('setting_id', $setting->id)->first();
            $this->countdown = $countdown->value;
        }

        $this->getLatestDataSensor();

        return view('livewire.sensors.data-sensor');
    }

    public function resetInputFields()
    {
        $this->reset(['countdown']);

        // Reset input values for limitSensorValues and sensorNotificationValues
        $this->limitSensorValues = [];
        $this->sensorNotificationValues = [];

        // Reset validation errors
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeCrudModal()
    {
        $this->resetInputFields();
        $this->showSensorModal = false;
    }
}
