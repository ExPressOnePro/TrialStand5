<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
                'module.stand',
                'stand.settings',
                'stand.history',
                'stand.create',
                'stand.make_entry',
                'stand.delete_entry',
                'stand.change_entry',
                'module.contacts',
                'module.schedule',
                'congregation.add_module',
                'congregation.change_settings',
                'congregation.open_meetings_responsible_users',
                'congregation.open_meetings_users',
                'congregation.open_congregation',
                ],
            'slug' => [
                'module.stand',
                'stand.settings',
                'stand.history',
                'stand.create',
                'stand.make_entry',
                'stand.delete_entry',
                'stand.change_entry',
                'module.contacts',
                'module.schedule',
                'congregation.add_module',
                'congregation.change_settings',
                'congregation.open_meetings_responsible_users',
                'congregation.open_meetings_users',
                'congregation.open_congregation',
                ]
        ];

        foreach($array['name'] as $key => $value){
            $permission = new Permission();
            $permission->name = $value;
            $permission->slug = $array['slug'][$key];
            $permission->save();
        }
    }
}
