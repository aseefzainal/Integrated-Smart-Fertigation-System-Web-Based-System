<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Schedule;
use App\Models\ProjectInput;
use App\Models\ProjectSensor;
use App\Services\Notifications;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\SensorNotification;

class MqttSubscribe extends Command
{
    protected $notificationService;
    protected $signature = 'mqtt:subscribe {topic}';

    protected $description = 'Subscribe to a given MQTT topic and display messages in the terminal';

    public function __construct(Notifications $notification)
    {
        parent::__construct();
        $this->notificationService = $notification;
    }

    public function handleSubscriberCallback(): callable
    {
        return function (string $topic, string $message) {
            $this->info(sprintf("Received message on topic [%s]: %s", $topic, $message));

            // Decode the JSON message into an associative array
            $data = json_decode($message, true);

            if (is_array($data) && isset($data['status_input'])) {
                foreach ($data['status_input'] as $input) {
                    if (isset($input['inputId'], $input['status'])) {
                        $this->info(sprintf("Received message on topic [%s]: inputID: %s - input status: %s", $topic, $input['inputId'], $input['status']));
                        // $this->info(sprintf("Received message on topic [%s]: input status: %s", $topic, $input['status']));
                        $projectInput = ProjectInput::find($input['inputId']);
                        $projectInput->status = $input['status'];
                        $projectInput->save();

                        if (isset($input['scheduleId'])) {
                            // $this->info(sprintf("Received message on topic [%s]: inputID: %s - input status: %s - schedule ID: %s", $topic, $input['inputId'], $input['status'], $input['scheduleId']));
                            $schedule = Schedule::find($input['scheduleId']);
                            $schedule->status = 2;
                            $schedule->save();
                        }
                    }
                }
            }

            if (is_array($data) && isset($data['project_id'], $data['status'], $data['sensor_data'])) {
                $this->info(sprintf("Received message from Project ID [%s]: ESP32 Status - %s", $data['project_id'], $data['status'] ? 'ON' : 'OFF'));

                $project = Project::find($data['project_id']);
                if ($project) {
                    // Update last active time and status
                    $project->update([
                        'last_active_at' => now(),
                        'status' => $data['status'],
                    ]);
                }

                foreach ($data['sensor_data'] as $sensor) {
                    // $this->info(sprintf("Received message on topic [%s]: %s - %s - %s", $topic, $data['project_id'], $sensor['sensor_id'], $sensor['value']));
                    // Check if required fields are present
                    if (isset($sensor['sensor_id'], $sensor['value'])) {
                        $this->info(sprintf("Sensor ID [%s]: Value - %s", $sensor['sensor_id'], $sensor['value']));
                        // Save to the database
                        // ProjectSensor::updateOrCreate(
                        // Save sensor data to the database
                        ProjectSensor::create([
                            'project_id' => $data['project_id'],
                            'sensor_id' => $sensor['sensor_id'],
                            'value' => $sensor['value'],
                        ]);

                        // Handle notifications as before
                        $sensorNotification = SensorNotification::where('project_id', $data['project_id'])
                            ->where('sensor_id', $sensor['sensor_id'])
                            ->first();

                        if ($sensorNotification && $sensorNotification->is_sent == false && $sensor['value'] <= $sensorNotification->value) {
                            $this->info(sprintf("Received message on topic [%s]: %s", $topic, "have notification"));
                            // $project = Project::find($data['project_id']);

                            $settings = $project->user->settings()->where('name', 'sensor_notification')->first();
                            $sensorNotifications = json_decode($settings->pivot->value, true);

                            $whatsAppMessage = "*🚨 Alert* 🚨\n" .
                                "🛠️ *Project:* " . $project->name . "\n" .
                                "📉 *Sensor:* " . $sensorNotification->sensor->name . "\n" .
                                "📊 *Threshold Value:* " . $sensorNotification->value . $sensorNotification->sensor->unit . "\n" .
                                "🔍 *Current Value:* " . $sensor['value'] . $sensorNotification->sensor->unit . "\n\n" .
                                "Please take the necessary action!";

                            $smsMessage = "Alert\n" .
                                "Project:" . $project->name . "\n" .
                                "Sensor: " . $sensorNotification->sensor->name . "\n" .
                                "Threshold Value: " . $sensorNotification->value . $sensorNotification->sensor->unit . "\n" .
                                "Current Value: " . $sensor['value'] . $sensorNotification->sensor->unit . "\n\n" .
                                "Please take the necessary action!";

                            foreach ($sensorNotifications as $notification) {
                                if ($notification['status']) {

                                    $this->info(sprintf("Send Notification on ProjectID [%s]: %s - %s", $sensor['project_id'], $notification['name'], $message));

                                    if ($notification['name'] === 'WhatsApp') {
                                        // $this->info(sprintf("Send Notification on ProjectID [%s]: %s - %s", $sensor['project_id'], $notification['name'], true));
                                        $this->notificationService->sendWhatsApp($project->user, $whatsAppMessage);
                                    }

                                    if ($notification['name'] === 'SMS') {
                                        // $this->info(sprintf("Send Notification on ProjectID [%s]: %s - %s", $sensor['project_id'], $notification['name'], true));
                                        $this->notificationService->sendSms($project->user, $smsMessage);
                                    }

                                    // if ($notification['name'] === 'Telegram') {
                                    // }

                                    // if ($notification['name'] === 'Email') {
                                    // }

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
                    }
                }
            } else {
                $this->error("Invalid message format: " . $message);
            }

            // if (is_array($data) && isset($data['project_id'], $data['status'], $data['sensor_data'])) {
            //     $this->info(sprintf("Received message from Project ID [%s]: ESP32 Status - %s", $data['project_id'], $data['status'] ? 'ON' : 'OFF'));

            //     foreach ($data['sensor_data'] as $sensor) {
            //         // Validate sensor data
            //         if (isset($sensor['sensor_id'], $sensor['value'])) {
            //             $this->info(sprintf("Sensor ID [%s]: Value - %s", $sensor['sensor_id'], $sensor['value']));

            //             // Save sensor data to the database
            //             ProjectSensor::create([
            //                 'project_id' => $data['project_id'],
            //                 'sensor_id' => $sensor['sensor_id'],
            //                 'value' => $sensor['value'],
            //             ]);

            //             // Handle notifications as before
            //             $sensorNotification = SensorNotification::where('project_id', $data['project_id'])
            //                 ->where('sensor_id', $sensor['sensor_id'])
            //                 ->first();

            //             if ($sensorNotification && !$sensorNotification->is_sent && $sensor['value'] <= $sensorNotification->value) {
            //                 // Send notifications (SMS, WhatsApp, etc.)
            //                 $this->sendNotification($data['project_id'], $sensor, $sensorNotification);
            //                 $sensorNotification->update(['is_sent' => true]);
            //             }
            //         }
            //     }
            // } else {
            //     $this->error("Invalid message format: " . json_encode($data));
            // }
        };
    }

    public function handle()
    {
        $topic = $this->argument('topic');

        $mqtt = MQTT::connection();

        $this->info("Subscribing to topic: {$topic}");

        $mqtt->subscribe($topic, $this->handleSubscriberCallback());

        $mqtt->loop(true);
    }
}
