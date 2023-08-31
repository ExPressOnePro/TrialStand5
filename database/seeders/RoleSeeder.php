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
                'Overseer',
                'Ministerial servants',
                'Regular pioneer',
                'Publisher',
            ],
            'slug' => [
                'Developer',
                'Guest',
                'Overseer',
                'Ministerial servants',
                'Regular pioneer',
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
            'role_id' => 2,
            'user_id' => 2,
        ]);
    }
}
