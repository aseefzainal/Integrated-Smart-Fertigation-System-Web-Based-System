<?php

use App\Models\User;
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
    return view('device', [
        'projects' => $user->projects,
        'inputs' => '',
        'schedules' => '',
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
