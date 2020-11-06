<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'administrator',
            'email' => 'administrator@cat.com',
            'email_verified_at' => now(),
            'password' => bcrypt('bjm12345'),
            'remember_token' => Str::random(10)
        ]);

        $user->assignRole('administrator');
    }
}
