<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Admin\AdminUser::create([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin' . \Illuminate\Support\Str::random(2) . '@admin.com',
            'password'  => Hash::make('password'),
            'role' => 1
        ]);
    }
}
