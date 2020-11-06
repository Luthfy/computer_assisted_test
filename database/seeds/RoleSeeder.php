<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name" => 'administrator',
            "guard_name" => 'web'
        ]);

        Role::create([
            "name" => 'participant',
            "guard_name" => 'web'
        ]);
    }
}
