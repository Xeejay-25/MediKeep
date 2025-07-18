<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'cj25efren@gmail.com',
                'password' => bcrypt('medikeepadmin'),
                'role' => User::ROLE_ADMIN, 
                'status' => 'approved',
                'email_verified_at' => Carbon::now(),
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
