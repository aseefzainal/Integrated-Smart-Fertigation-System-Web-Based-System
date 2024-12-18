<?php

use App\Livewire\Device;
use App\Livewire\Profile;
use App\Livewire\Setting;
use App\Livewire\CreateNewUser;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user-list', Dashboard::class);

Route::get('/profile/{user:username}', Profile::class);

Route::get('/setting/{user:username}', Setting::class);

// Route::get('/profile/{user:username}', function (User $user) {
//     return view('profile', ['user' => $user]);
// });

Route::get('/device/{user:username}', Device::class);

Route::get('/create-new-user', CreateNewUser::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
