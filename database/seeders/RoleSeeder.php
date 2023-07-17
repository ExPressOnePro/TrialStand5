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
    }
}
