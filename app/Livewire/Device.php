<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Setting;
use Livewire\Component;
use App\Models\LimitSensor;
use App\Models\UserSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\SensorNotification;

#[Layout('components.my-layouts.layout')]
class Device extends Component
{
    public $user;
    public $project;
    public $showSensorModal = false;
    public $tab = 1;

    #[Validate('required|numeric|min:0')]
    public $limitSensor;

    #[Validate('required|numeric|min:5|max:10')]
    public $countdown;

    public $sensorNotificationValues = [];
    public $limitSensorValues = [];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->project = $this->user->projects->first();
    }

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

    public function save()
    {
        foreach ($this->sensorNotificationValues as $sensorId => $value) {
            SensorNotification::updateOrCreate(
                ['id' => $sensorId],  // This is the condition to find the existing record
                [
                    'value' => $value,
                    // 'countdown' => $this->countdown
                ]
            );

            // Retrieve the 'countdown' setting by name
            $countdownSetting = Setting::where('name', 'countdown')->first();

            if ($countdownSetting) {
                // $newValue = 10; // Replace with the new value you want for the countdown

                // Update the pivot value for only the countdown setting
                $this->user->settings()->updateExistingPivot($countdownSetting->id, ['value' => $this->countdown]);
            }
        }

        foreach ($this->limitSensorValues as $sensorId => $value) {
            // Use updateOrCreate to update existing data or create new data
            LimitSensor::updateOrCreate(
                ['id' => $sensorId],  // This is the condition to find the existing record
                [
                    'value' => $value,
                ]  // These are the fields to update or create
            );
        }

        $this->resetInputFields();
        session()->flash('success', 'Sensor setting updated successfully!');
        $this->showSensorModal = false;
    }

    public function render()
    {
        if (!$this->project) {
            return view('livewire.device', ['projects' => $this->user->projects]);
        }

        $sensors = $this->project->latestSensors()->get();


        $limitSensors = $this->project->limitSensors;

        if (!$limitSensors->isEmpty()) {
            foreach ($limitSensors as $sensor) {
                if (!isset($this->limitSensorValues[$sensor->id])) {
                    $this->limitSensorValues[$sensor->id] = $sensor->value;  // Only load if not already set
                }
            }
        }

        $sensorNotifications = $this->project->sensorNotifications;

        if (!$sensorNotifications->isEmpty()) {

            foreach ($sensorNotifications as $sensor) {
                if (!isset($this->sensorNotificationValues[$sensor->id])) {
                    $this->sensorNotificationValues[$sensor->id] = $sensor->value;  // Only load if not already set
                }
            }

            if (!isset($this->countdown)) {
                // $this->countdown = $sensorNotifications[0]->countdown;

                $setting = Setting::where('name', 'countdown')->first();
                
                // $user->settings()->updateExistingPivot($setting->id, ['value' => $this->countdown]);
                $countdown = UserSetting::where('user_id', $this->user->id)->where('setting_id', $setting->id)->first();
                $this->countdown = $countdown->value;
            }
        }

        return view('livewire.device', [
            'projects' => $this->user->projects,
            'project_id' => $this->project->id,
            'sensors' => $sensors,
            'limitSensors' => $limitSensors ?? [],
            'sensorNotifications' => $sensorNotifications ?? []
        ]);
    }

    public function updateProjectId($project_id)
    {
        $this->project = $this->user->projects->where('id', $project_id)->first();

        $this->dispatch('projectSelected', projectId: $project_id);
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
