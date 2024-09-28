<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'title' => 'Mr',
                'name' => 'Ahmad Aseef Bin Zainal Abidin',
                'username' => '@aseef_zainal',
                'email' => 'aseefzainal65@gmail.com',
                'email_verified_at' => now(),
                'phone' => '+601165157010',
                'role' => 'admin',
                'gender' => 'male',
                'birthday' => '2000-02-05',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Azlan Abdullah',
                'username' => '@azlan_abdullah',
                'email' => 'lanjayatrading@gmail.com',
                'phone' => '+601125658191',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Abdullah Muaz Bin Sapuan',
                'username' => '@loh_muaz',
                'email' => 'loh.abdullah98@gmail.com',
                'phone' => '+60142980509',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
