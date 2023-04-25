<?php

namespace Database\Seeders;
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
        $manager = new Role();
        $manager->name = 'Developer';
        $manager->slug = 'Dev';
        $manager->save();
        $manager = new Role();
        $manager->name = 'User';
        $manager->slug = 'User';
        $manager->save();
    }
}
