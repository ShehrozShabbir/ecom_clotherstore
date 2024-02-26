<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a default user
        User::create([
            'name' => 'Arlsan',
            'email' => 'arslan@medtronix.com',
            'password' => Hash::make('Pass@786'),
            'role'=>'admin',

        ]);

        // You can add more users or customize the user creation as needed
    }
}
