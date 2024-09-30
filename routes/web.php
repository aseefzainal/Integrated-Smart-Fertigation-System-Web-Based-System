<?php

use App\Models\ProjectSensor;
use App\Models\User;
use App\Models\SensorReading;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('user-list', ['users' => User::where('role', 'user')->paginate(10)]);
});

Route::get('/profile/{user:username}', function (User $user) {
    return view('profile', ['user' => $user]);
});

Route::get('/device/{user:username} ', function (User $user) {

    $project = $user->projects->first();

    // Get the latest readings for all sensors
    $sensors = $project->latestSensors()->get();

    // Fetch the last 10 readings for a specific sensor
    $sensorReadings = ProjectSensor::where('sensor_id', 1)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    // dd($project->latestSensors);

    return view('device', [
        'projects' => $user->projects,
        'inputs' => $project->inputs,
        'schedules' => $project->schedules()->paginate(5),
        'sensors' => $sensors,
        'sensorReadings' => $sensorReadings // Pass sensor readings to the view
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
