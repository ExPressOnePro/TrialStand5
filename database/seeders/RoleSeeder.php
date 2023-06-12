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
        $guest = new Role();
        $guest->name = 'Guest';
        $guest->slug = 'Guest';
        $guest->save();

        $user = new Role();
        $user->name = 'User';
        $user->slug = 'User';
        $user->save();

        $developer = new Role();
        $developer->name = 'Developer';
        $developer->slug = 'Developer';
        $developer->save();

        $manager = new Role();
        $manager->name = 'Manager';
        $manager->slug = 'Manager';
        $manager->save();
    }
}
