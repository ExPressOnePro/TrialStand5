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
                'Manager.User manager',
                'Developer.User manager',
                'User. Stand. Open table',
                'Manager. Congregations. Open Congregation',
                'Developer. Congregations. Open all Congregations',
                'Manager. Stand. Open settings stand',
                'Manager. Stand. Create new stand',
                'User. Stand. Entry in table',
                'Open Congregations',
                'Publisher. Stand. Open table',
                'Manager. Stand. Open history stand'
                ],
            'slug' => [
                'Manager.User manager',
                'Developer.User manager',
                'User. Stand. Open table',
                'Manager. Congregations. Open Congregation',
                'Developer. Congregations. Open all Congregations',
                'Manager. Stand. Open settings stand',
                'Manager. Stand. Create new stand',
                'User. Stand. Entry in table',
                'Open Congregations',
                'Publisher. Stand. Open table',
                'Manager. Stand. Open history stand'
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
