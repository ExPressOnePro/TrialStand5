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
        $congregation->name = 'Бельцы - Пэмынтень';
        $congregation->save();

        $congregation = new Congregation();
        $congregation->name = 'Бельцы - Центр';
        $congregation->save();
    }
}
