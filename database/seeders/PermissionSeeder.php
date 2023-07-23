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
                'Users-Open congregation users',
                'Users-Open all users',
                'Congregations-Open congregation',
                'Congregations-Open all congregations',
                'Stand-Open settings stand',
                'Stand-Open history stand',
                'Stand-Create new stand',
                'Stand-Open stand table',
                'Stand-Entry in table',
                ],
            'slug' => [
                'Users-Open congregation users',
                'Users-Open all users',
                'Congregations-Open Congregation',
                'Congregations-Open all Congregations',
                'Stand-Open settings stand',
                'Stand-Open history stand',
                'Stand-Create new stand',
                'Stand-Open stand table',
                'Stand-Entry in table',
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
