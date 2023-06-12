<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\UsersRoles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = Role::where('name','Developer')->first();
        $manager = Role::where('name', 'Manager')->first();
        $createTasks = Permission::where('slug','create-tasks')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();

        $user1 = new User();
        $user1->name = 'Jhon Deo';
        $user1->login = 'jndeo';
        $user1->email = 'jhon@deo.com';
        $user1->congregation_id = '1';
        $user1->password = bcrypt('secret');
        $user1->save();
        $user1->roles()->attach($developer);
        $user1->permissions()->attach($createTasks);

        $user2 = new User();
        $user2->name = 'Mike Thomas';
        $user2->login = 'Mithomas';
        $user2->email = 'mike@thomas.com';
        $user2->congregation_id = '1';
        $user2->password = bcrypt('secret');
        $user2->save();
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($manageUsers);

        $user3 = new User();
        $user3->name = 'Tode Fills';
        $user3->login = 'TeFills';
        $user3->email = 'Tod@Fills.com';
        $user3->congregation_id = '1';
        $user3->password = bcrypt('secret');
        $user3->save();
        $user3->roles()->attach($manager);
        $user3->permissions()->attach($manageUsers);
    }
}
