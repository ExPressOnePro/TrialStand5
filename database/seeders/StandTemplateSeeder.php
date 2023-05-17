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

        $congregation_id = 1;

        $stands = [
            [
                'congregation_id' => $congregation_id,
                'name' => 'Стелуца',
                'location' => 'ул. Стелуца',
            ],
        ];

        foreach($stands as $stand) {
            DB::table(app(Stand::class)->getTable())->insert($stand);
        }

        $stand_templates = [
            [
                'day' => 1,
                'time' => '00:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '01:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '02:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '03:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '04:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '05:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '06:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '07:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '08:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '09:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '10:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '11:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '12:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '13:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [

                'day' => 1,
                'time' => '14:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '15:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '16:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '17:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '18:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '19:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '20:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '21:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '22:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],
            [
                'day' => 1,
                'time' => '23:00',
                'status' => '1',
                'stand_id' => Stand::whereName('Стелуца')->first()->id,
                'congregation_id' => $congregation_id,
            ],

        ];

        foreach($stand_templates as $stand_template) {
            $stand_template_id = DB::table(app(StandTemplate::class)->getTable())->insertGetId($stand_template);
        }

    }
}
