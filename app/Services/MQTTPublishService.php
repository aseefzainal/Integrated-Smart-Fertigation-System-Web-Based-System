<?php

namespace App\Services;

use App\Models\Sensor;
use App\Models\Project;
use App\Models\ProjectInput;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Log;

class MQTTPublishService
{
    public function publishInputStatus(ProjectInput $input, $scheduleId = null)
    {
        if ($input->input->slug === 'fertilizer-irrigation') {
            $project = Project::find($input->project->id);
            $sensor = Sensor::where('slug', 'ec')->first();

            // Fetch the limit sensor for the project and sensor
            $limitSensor = $project->limitSensors()->where('sensor_id', $sensor->id)->first();

            if ($limitSensor) {
                $limitSensorValue = $limitSensor->value;

                // Publish the updated status to MQTT
                $this->publishStatusToMQTT($input->project->id, $input->id, $input->input->slug, $input->status, $input->duration, $scheduleId, $limitSensorValue);
            }
        } else {
            $this->publishStatusToMQTT($input->project->id, $input->id, $input->input->slug, $input->status, $input->duration, $scheduleId);
        }
    }

    protected function publishStatusToMQTT($projectId, $inputId, $inputSlug, $status, $duration, $scheduleId, $limitSensorValue = null)
    {
        // Assuming you have a MQTT connection method or service
        try {
            $mqtt = MQTT::connection();
            $topic = "switch-button"; // Set your topic here
            $message = json_encode(['projectId' => $projectId, 'inputId' => $inputId, 'slug' => $inputSlug, 'status' => $status, 'duration' => $duration, 'limitSensor' => $limitSensorValue, 'scheduleId' => $scheduleId]);

            // Publish the status
            $mqtt->publish($topic, $message);

            // Disconnect from the MQTT broker
            $mqtt->disconnect();
        } catch (\Exception $e) {
            // Handle connection errors or any other exceptions
            Log::error("MQTT Publish Error: " . $e->getMessage());
        }
    }
}
