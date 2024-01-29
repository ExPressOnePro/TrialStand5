<?php

namespace Database\Seeders;

use App\Models\Congregation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CongregationSeeder extends Seeder
{
    public function run(): void
    {
        $congregation = new Congregation();
        $congregation->name = 'Guest';
        $congregation->save();

        $congregation = new Congregation();
        $congregation->name = 'Бельцы - Пэмынтены';
        $congregation->info = json_encode(['weekday' => '3', 'weekend' =>  '6', 'weekdayTime' =>  '19:00', 'weekendTime' =>  '18:00']);
//        $congregation->address = 'Дософтей 20';
//        $congregation->district = '5';
//        $congregation->country = 'Молдова';
//        $congregation->weekday_meeting = '3-19:00';
//        $congregation->weekend_meeting = '6-18:00';
        $congregation->save();

        $congregation = new Congregation();
        $congregation->name = 'Бельцы - Дачиа';
//        $congregation->address = 'Дософтей 20';
//        $congregation->district = '5';
//        $congregation->country = 'Молдова';
//        $congregation->weekday_meeting = '4-19:00';
//        $congregation->weekend_meeting = '7-13:00';
        $congregation->save();

        $congregation = new Congregation();
        $congregation->name = 'Кишинев - Буюкань';
//        $congregation->address = 'Дософтей 20';
//        $congregation->district = '5';
//        $congregation->country = 'Молдова';
//        $congregation->weekday_meeting = '4-19:00';
//        $congregation->weekend_meeting = '7-13:00';
        $congregation->save();

    }
}
