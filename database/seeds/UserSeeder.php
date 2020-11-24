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
        $user_role = 'administrator';

        $user = User::create([
            'name' => 'administrator',
            'email' => 'educpns.id@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('bjm12345'),
            'remember_token' => Str::random(10),
            'user_role' => $user_role
        ]);

        $user->assignRole($user_role);
    }
}
