<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\UsersRoles;
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

        $array = [
            'name' => [
                'Developer',
                'Guest',
                'responsible behind stand',
                'User-',
            ],
            'slug' => [
                'Developer',
                'Guest',
                'responsible behind stand',
                'Publisher',
            ]
        ];

        foreach($array['name'] as $key => $value){
            $role = new Role();
            $role->name = $value;
            $role->slug = $array['slug'][$key];
            $role->save();
        }

        UsersRoles::create([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        UsersRoles::create([
            'role_id' => 1,
            'user_id' => 2,
        ]);
    }
}
