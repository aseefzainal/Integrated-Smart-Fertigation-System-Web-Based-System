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
    if (!$project) {
        return view(
            'device', ['projects' => $user->projects]
        );
    }

    $sensors = $project->latestSensors()->get();

    // // Fetch the last 10 readings for a specific sensor
    // $sensorReadings = ProjectSensor::where('sensor_id', 1)
    //     ->where('project_id', $project->id)
    //     ->orderBy('created_at', 'desc')
    //     ->take(10)
    //     ->get();

    // // Prepare the data for Chart.js (reverse the order to get oldest to newest)
    // $data = $sensorReadings->pluck('value')->reverse()->values()->toArray(); // Sensor values for the chart
    // $labels = $sensorReadings->pluck('created_at')->reverse()->map(function ($date) {
    //     // return $date->format('g:i:s A');
    //     return $date->format('g:i:s');
    // })->values()->toArray();  // Use values() to reset numeric keys

    // dd($project->sensors);

    return view('device', [
        'projects' => $user->projects,
        // 'inputs' => $project->load('inputs')->inputs,
        // 'inputs' => $project->inputs,
        // 'schedules' => $project->schedules()->paginate(5) ?? null,
        // 'schedules' => $project->schedules,
        'sensors' => $sensors,
        // 'chartData' => [
        //     'labels' => $labels,
        //     'data' => $data
        // ]

        // 'inputs' => collect($project->inputs ?? []),
        // 'schedules' => collect($project->inputs ?? []),
        // 'sensors' => collect($sensors ?? []),
        // 'chartData' => [
        //     'labels' => $labels ?? null,
        //     'data' => $data ?? null
        // ]
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
