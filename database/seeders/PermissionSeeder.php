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
                'Stand-Open settings stand',
                'Stand-Open history stand',
                'Stand-Create new stand',
                'Stand-Open stand table',
                'Stand-Entry in table',
                'module.stand',
                'module.contacts',
                'module.report',
                'module.schedule',
                'congregation.add_module',
                'congregation.change_settings',
                'congregation.open_meetings_responsible_users',
                'congregation.open_meetings_users',
                'congregation.open_congregation',
                ],
            'slug' => [
                'Users-Open congregation users',
                'Users-Open all users',
                'Users-Change role',
                'Users-Change permissions',
                'congregation.open_congregation',
                'congregation.open_all_congregations',
                'Stand-Open settings stand',
                'Stand-Open history stand',
                'Stand-Create new stand',
                'Stand-Open stand table',
                'Stand-Entry in table',
                'module.stand',
                'module.contacts',
                'module.report',
                'module.schedule',
                'congregation.add_module',
                'congregation.change_settings',
                'congregation.open_meetings_responsible_users',
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
