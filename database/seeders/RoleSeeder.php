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
                'HS', //head stand
                'US-1',
                'US-2',
                'US-3',
            ],
            'slug' => [
                'Developer',
                'Guest',
                'HS',
                'US-1',
                'US-2',
                'US-3',
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
