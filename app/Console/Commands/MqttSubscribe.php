<?php

namespace App\Console\Commands;

use App\Models\Project;
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

            if (is_array($data) && isset($data['sensor_data'])) {
                foreach ($data['sensor_data'] as $sensor) {
                    // Check if required fields are present
                    if (isset($sensor['project_id'], $sensor['sensor_id'], $sensor['value'])) {
                        // Save to the database
                        // ProjectSensor::updateOrCreate(
                        $idProjectSensor = ProjectSensor::create(
                            [
                                'project_id' => $sensor['project_id'],
                                'sensor_id' => $sensor['sensor_id'],
                                'value' => $sensor['value'],
                            ],
                        );

                        $sensorNotification = SensorNotification::where('project_id', $sensor['project_id'])->where('sensor_id', $sensor['sensor_id'])->first();

                        if ($sensorNotification->is_sent == false && $sensor['value'] <= $sensorNotification->value) {
                            $project = Project::find($sensor['project_id']);

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
                                        $this->notificationService->sendWhatsApp($project->user->phone, $whatsAppMessage);
                                    }

                                    // if ($notification['name'] === 'SMS') {
                                    //     // $this->info(sprintf("Send Notification on ProjectID [%s]: %s - %s", $sensor['project_id'], $notification['name'], true));
                                    //     $this->notificationService->sendSms($project->user->phone, $smsMessage);
                                    // }

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
        };
    }

    public function handle()
    {
        $topic = $this->argument('topic');

        $mqtt = MQTT::connection();

        $this->info("Subscribing to topic: {$topic}");

        // $mqtt->subscribe($topic, function (string $topic, string $message) {
        //     $this->info(sprintf("Received message on topic [%s]: %s", $topic, $message));

        //     // Decode the JSON message into an associative array
        //     $data = json_decode($message, true);

        //     if (is_array($data) && isset($data['sensor_data'])) {
        //         foreach ($data['sensor_data'] as $sensor) {
        //             // Check if required fields are present
        //             if (isset($sensor['project_id'], $sensor['sensor_id'], $sensor['value'])) {
        //                 // Save to the database
        //                 // ProjectSensor::updateOrCreate(
        //                 $idProjectSensor = ProjectSensor::create(
        //                     [
        //                         'project_id' => $sensor['project_id'],
        //                         'sensor_id' => $sensor['sensor_id'],
        //                         'value' => $sensor['value'],
        //                     ],
        //                 );

        //                 $sensorNotification = SensorNotification::where('project_id', $sensor['project_id'])->where('sensor_id', $sensor['sensor_id'])->first();

        //                 if ($sensorNotification->is_sent == false && $sensor['value'] <= $sensorNotification->value) {
        //                     $project = Project::find($sensor['project_id']);

        //                     $settings = $project->user->settings()->where('name', 'sensor_notification')->first();
        //                     $sensorNotifications = json_decode($settings->pivot->value, true);

        //                     $whatsAppMessage = "*🚨 Alert* 🚨\n" .
        //                         "🛠️ *Project:* " . $project->name . "\n" .
        //                         "📉 *Sensor:* " . $sensorNotification->sensor->name . "\n" .
        //                         "📊 *Threshold Value:* " . $sensorNotification->value . $sensorNotification->sensor->unit . "\n" .
        //                         "🔍 *Current Value:* " . $sensor['value'] . $sensorNotification->sensor->unit . "\n\n" .
        //                         "Please take the necessary action!";

        //                     $smsMessage = "Alert\n" .
        //                         "Project:" . $project->name . "\n" .
        //                         "Sensor: " . $sensorNotification->sensor->name . "\n" .
        //                         "Threshold Value: " . $sensorNotification->value . $sensorNotification->sensor->unit . "\n" .
        //                         "Current Value: " . $sensor['value'] . $sensorNotification->sensor->unit . "\n\n" .
        //                         "Please take the necessary action!";

        //                     foreach ($sensorNotifications as $notification) {
        //                         if ($notification['status']) {

        //                             $this->info(sprintf("Send Notification on ProjectID [%s]: %s - %s", $sensor['project_id'], $notification['name'], $message));

        //                             if ($notification['name'] === 'WhatsApp') {
        //                                 // $this->info(sprintf("Send Notification on ProjectID [%s]: %s - %s", $sensor['project_id'], $notification['name'], true));
        //                                 $this->notificationService->sendWhatsApp($project->user->phone, $whatsAppMessage);
        //                             }

        //                             // if ($notification['name'] === 'SMS') {
        //                             //     // $this->info(sprintf("Send Notification on ProjectID [%s]: %s - %s", $sensor['project_id'], $notification['name'], true));
        //                             //     $this->notificationService->sendSms($project->user->phone, $smsMessage);
        //                             // }

        //                             // if ($notification['name'] === 'Telegram') {
        //                             // }

        //                             // if ($notification['name'] === 'Email') {
        //                             // }

        //                             SensorNotification::updateOrCreate(
        //                                 [
        //                                     'project_id' => $sensor['project_id'],
        //                                     'sensor_id' => $sensor['sensor_id'],
        //                                 ],
        //                                 [
        //                                     'is_sent' => true
        //                                 ]
        //                             );
        //                         }

        //                     }

        //                 }
        //             }
        //         }
        //     } else {
        //         $this->error("Invalid message format: " . $message);
        //     }
        // });

        $mqtt->subscribe($topic, $this->handleSubscriberCallback());

        $mqtt->loop(true);
    }
}
