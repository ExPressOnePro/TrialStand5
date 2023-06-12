<?php

namespace Database\Seeders;

use App\Models\Congregation;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stand_templates = [[
                'day' => '1',
                'type' => 'last',
                'time' => '00:00',
                'status' => '1',
                'stand_id' => '1',
                'congregation_id' => '1',
            ]];

        foreach($stand_templates as $stand_template) {
            $stand_template_id = DB::table(app(StandTemplate::class)->getTable())->insertGetId($stand_template);
        }

    }
}
