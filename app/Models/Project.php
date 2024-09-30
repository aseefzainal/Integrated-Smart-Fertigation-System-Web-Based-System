<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\ProjectSensor;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    use HasFactory;

    public function inputs(): BelongsToMany
    {
        return $this->belongsToMany(Input::class, 'project_inputs')->withPivot('custom_name', 'status');
    }

    public function schedules(): HasManyThrough
    {
        return $this->hasManyThrough(Schedule::class, ProjectInput::class);
    }

    public function latestSensors()
    {
        return ProjectSensor::select('project_sensors.*', 'sensors.name', 'sensors.unit')
            ->join('sensors', 'project_sensors.sensor_id', '=', 'sensors.id')
            ->where('project_sensors.project_id', $this->id) // Filter by current project
            ->whereIn('project_sensors.id', function ($query) {
                $query->select(DB::raw('MAX(id)')) // Get the latest sensor reading
                    ->from('project_sensors')
                    ->groupBy('sensor_id', 'project_id'); // Group by sensor_id and project_id
            });
    }
}