<?php

namespace App\Console\Commands;

use App\Models\Congregation;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use Illuminate\Console\Command;

class updatePublishers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-publishers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(){

        #•current ID переписать в StandPublishers Stand_template_ID
        $congr_id = Congregation::get();
        $stand_id = Stand::get();
        $time_array = [
            '00:00',
            '01:00',
            '02:00',
            '03:00',
            '04:00',
            '05:00',
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00',
        ];
        $day_array = [1, 2, 3, 4, 5, 6, 7];

        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($day_array as $dar) {
                    foreach ($time_array as $time_arr) {
                        $stand_template_id_next = StandTemplate::
                        where('type', '=', 'next')
                            ->where('day', $dar)
                            ->where('time', $time_arr)
                            ->where('stand_id', $sid->id)
                            ->where('congregation_id', $cid->id)
                            ->get();
                        $stand_template_id_current = StandTemplate::
                        where('type', '=', 'current')
                            ->where('day', $dar)
                            ->where('time', $time_arr)
                            ->where('stand_id', $sid->id)
                            ->where('congregation_id', $cid->id)
                            ->get();
                        foreach ($stand_template_id_next as $stin) {
                            foreach ($stand_template_id_current as $stic) {
                                $rertt = StandPublishers::where('stand_template_id', $stin->id)
                                    ->update([
                                        'stand_template_id' => $stic->id
                                    ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
