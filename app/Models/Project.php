<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\ProjectSensor;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inputs(): BelongsToMany
    {
        return $this->belongsToMany(Input::class, 'project_inputs')->withPivot('id', 'custom_name', 'status', 'duration');
    }

    public function category(): BelongsTo
{
    return $this->belongsTo(ProjectCategory::class, 'category_id');
}

    public function schedules(): HasManyThrough
    {
        return $this->hasManyThrough(Schedule::class, ProjectInput::class);
    }

    public function projectSensor(): HasMany
    {
        return $this->hasMany(ProjectSensor::class);
    }

    public function latestSensors()
    {
        return ProjectSensor::select('project_sensors.*', 'sensors.name', 'sensors.unit', 'sensors.slug')
            ->join('sensors', 'project_sensors.sensor_id', '=', 'sensors.id')
            ->where('project_sensors.project_id', $this->id) // Filter by current project
            ->whereIn('project_sensors.id', function ($query) {
                $query->select(DB::raw('MAX(id)')) // Get the latest sensor reading
                    ->from('project_sensors')
                    ->groupBy('sensor_id', 'project_id'); // Group by sensor_id and project_id
            });
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function limitSensors(): HasMany
    {
        return $this->hasMany(LimitSensor::class);
    }

    public function sensorNotifications(): HasMany
    {
        return $this->hasMany(SensorNotification::class);
    }
}
