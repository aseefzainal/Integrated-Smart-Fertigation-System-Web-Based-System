<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSensor extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    // Event to handle default settings on project sensor creation
    protected static function booted()
    {
        static::created(function ($projectSensor) {
            // Fetch the sensor with the given sensor_id
            $sensor = Sensor::find($projectSensor->sensor_id);

            // Check if the sensor exists
            if ($sensor) {
                // Create SensorNotification if it doesn't exist
                $sensorNotificationExists = SensorNotification::where('project_id', $projectSensor->project_id)
                    ->where('sensor_id', $sensor->id)
                    ->exists();

                if (!$sensorNotificationExists) {
                    SensorNotification::create([
                        'project_id' => $projectSensor->project_id,
                        'sensor_id' => $projectSensor->sensor_id,
                    ]);
                }

                // If the sensor slug is 'ec', check and create LimitSensor
                if ($sensor->slug == 'ec') {
                    // Check if the LimitSensor already exists
                    $limitSensorExists = LimitSensor::where('project_id', $projectSensor->project_id)
                        ->where('sensor_id', $sensor->id)
                        ->exists();

                    // If it does not exist, create it
                    if (!$limitSensorExists) {
                        LimitSensor::create([
                            'project_id' => $projectSensor->project_id,
                            'sensor_id' => $sensor->id,
                            'value' => 0
                        ]);
                    }
                }
            }
        });
    }
}
