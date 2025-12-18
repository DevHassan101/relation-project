<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $roles = ['admin', 'user'];

        foreach($roles as $role){
            Role::create([
                'guard_name' => 'web',
                'name' => $role
            ]);
        }

        $users = [
            [
                'name' => 'Daniyal',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123@'),
                'role' => 'admin',
            ],

            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123@'),
                'role' => 'user',
            ],
        ];

        foreach($users as $user){
            $createUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            $createUser->assignRole($user['role']);
        }


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
