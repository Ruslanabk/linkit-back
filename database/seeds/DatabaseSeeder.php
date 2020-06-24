<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin')
        ]);
        User::create([
            'username' => 'John',
            'email' => 'john@doe.com',
            'password' => Hash::make('1234')
        ]);
    }
}
