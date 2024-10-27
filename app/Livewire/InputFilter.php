<?php

namespace App\Livewire;

use App\Models\Input;
use App\Models\Sensor;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProjectInput;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Log;

class InputFilter extends Component
{
    public $project_id;
    public $inputId;
    public $originalStatus;
    public $showInputModal = false;
    public $tab = 1;
    public $inputValues = [];
    public $controlType = 'auto';

    // protected $listeners = ['openModal' => 'openModal'];

    #[On('openModal')]
    public function openModal($inputId)
    {
        $this->inputId = $inputId;
        $input = ProjectInput::find($this->inputId);
        $this->originalStatus = $input->status;
        $this->dispatch('showModal');
    }

    public function toggleStatus()
    {
        sleep(5);

        $input = ProjectInput::find($this->inputId);
        $input->status = !$input->status;
        $input->save();

        $inputSlug = Input::find($input->input_id);

        if ($inputSlug->slug === 'fertilizer-irrigation') {
            $project = Project::find($this->project_id);
            $sensor = Sensor::where('slug', 'ec')->first();

            // Fetch the limit sensor for the project and sensor
            $limitSensor = $project->limitSensors()->where('sensor_id', $sensor->id)->first();

            if ($limitSensor) {
                $limitSensorValue = $limitSensor->value;

                // Publish the updated status to MQTT
                $this->publishStatusToMQTT($this->inputId, $input->status, $input->duration, $limitSensorValue);
            }
        } else {
            $this->publishStatusToMQTT($this->inputId, $input->status, $input->duration);
        }

        // Close modal after confirming
        $this->dispatch('hideModal');

        session()->flash('success', $input->custom_name . ' has successfully ' . ($input->status == 1 ? 'turned on.' : 'turned off.'));
    }

    protected function publishStatusToMQTT($inputId, $status, $duration, $limitSensorValue = null)
    {
        // Assuming you have a MQTT connection method or service
        try {
            $mqtt = MQTT::connection();
            $topic = "switch-button"; // Set your topic here
            $message = json_encode(['inputId' => $inputId, 'status' => $status, 'duration' => $duration, 'limitSensor' => $limitSensorValue]);

            // Publish the status
            $mqtt->publish($topic, $message);

            // Disconnect from the MQTT broker
            $mqtt->disconnect();
        } catch (\Exception $e) {
            // Handle connection errors or any other exceptions
            Log::error("MQTT Publish Error: " . $e->getMessage());
        }
    }

    public function messages()
    {
        return [
            'inputValues.*.custom_name.required' => 'The custom name field is required for all inputs.',
            'inputValues.*.custom_name.max' => 'The custom name must not exceed 255 characters.',
            'inputValues.*.duration.required' => 'The duration field is required for all inputs.',
            'inputValues.*.duration.integer' => 'The duration must be a valid integer.',
            'inputValues.*.duration.min' => 'The duration must be at least 0.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'inputValues.*.custom_name' => 'required|string|max:255',
            'inputValues.*.duration' => 'required|integer|min:0',
        ]);
    }

    public function save()
    {
        foreach ($this->inputValues as $inputId => $value) {
            // Use updateOrCreate to update existing data or create new data
            ProjectInput::updateOrCreate(
                ['id' => $inputId],  // This is the condition to find the existing record
                [
                    'custom_name' => $value['custom_name'],  // Extract custom_name from the array
                    'duration' => $value['duration'],        // Also extract duration if needed
                ]
            );
        }

        $this->resetInputFields();
        session()->flash('success', 'Input setting updated successfully!');
        $this->showInputModal = false;
    }

    public function resetInputFields()
    {
        // Reset input values for limitSensorValues and sensorNotificationValues
        $this->inputValues = [];

        // Reset validation errors
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeCrudModal()
    {
        // $this->reset(['hst', 'date', 'time', 'type']);
        $this->resetInputFields();
        $this->showInputModal = false;
    }

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    public function render()
    {
        $inputs = Project::findOrFail($this->project_id)
            ->inputs()
            // ->where('type', $this->controlType)
            ->get();

        if (!$inputs->isEmpty()) {
            foreach ($inputs as $input) {
                if (!isset($this->inputValues[$input->pivot->id])) {
                    // $this->inputValues[$input->pivot->id] = $input->pivot->custom_name;  // Only load if not already set
                    $this->inputValues[$input->pivot->id] = [
                        'custom_name' => $input->pivot->custom_name,
                        'duration' => $input->pivot->duration
                    ]; // Only load if not already set
                }
            }
        }

        // dd($this->inputValues);
        return view('livewire.input-filter', [
            'controlText' => $this->controlType === 'auto' ? 'Switch to Manual Control' : 'Switch to Auto Control',
            'inputs' => $inputs
        ]);
    }

    public function toggleControlType()
    {
        $this->controlType = $this->controlType === 'auto' ? 'manual' : 'auto';
    }

    #[On('projectSelected')]
    public function projectSelected($projectId)
    {
        $this->project_id = $projectId;
    }
}
