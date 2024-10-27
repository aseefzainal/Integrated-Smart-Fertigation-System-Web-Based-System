<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\ProjectSensor;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\SensorNotification;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe {topic}';

    protected $description = 'Subscribe to a given MQTT topic and display messages in the terminal';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $topic = $this->argument('topic');

        $mqtt = MQTT::connection();

        $this->info("Subscribing to topic: {$topic}");

        $mqtt->subscribe($topic, function (string $topic, string $message) use ($mqtt) {
            $this->info(sprintf("Received message on topic [%s]: %s", $topic, $message));

            // Decode the JSON message into an associative array
            $data = json_decode($message, true);

            if (is_array($data) && isset($data['sensor_data'])) {
                foreach ($data['sensor_data'] as $sensor) {
                    // Check if required fields are present
                    if (isset($sensor['project_id'], $sensor['sensor_id'], $sensor['value'])) {
                        // Save to the database
                        // ProjectSensor::updateOrCreate(
                        ProjectSensor::create(
                            [
                                'project_id' => $sensor['project_id'],
                                'sensor_id' => $sensor['sensor_id'],
                                'value' => $sensor['value'],
                            ],
                        );

                        $sensorNotification = SensorNotification::where('project_id', $sensor['project_id'])->where('sensor_id', $sensor['sensor_id'])->first();

                        if ($sensorNotification->is_sent == false && $sensor['value'] <= $sensorNotification->value) {
                            $project = Project::find($sensor['project_id']);
                            
                            // $project->user
                            $settings = $project->user->settings()->where('name', 'sensor_notification')->first();
                            $sensorNotifications = json_decode($settings->pivot->value, true);

                            foreach($sensorNotifications as $notification) {
                                if($notification['status']) {
                                    $this->info(sprintf("Send Notification on ProjectID [%s]: %s", $sensor['project_id'], $notification['name']));
                                }
                            }

                            SensorNotification::updateOrCreate(
                                [
                                    'project_id' => $sensor['project_id'],
                                    'sensor_id' => $sensor['sensor_id'],
                                ],
                                [
                                    'is_sent' => true
                                ]
                            );
                        }
                    }
                }
            } else {
                $this->error("Invalid message format: " . $message);
            }
        });

        $mqtt->loop(true);
    }
}
