<?php

namespace Database\Seeders;

use App\Models\Stand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

      //  \App\Models\User::factory(10)->create();
        $this->call(CongregationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RolesPermissionsSeeder::class);


    }
}
