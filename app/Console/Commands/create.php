<?php

namespace App\Console\Commands;

use App\Models\Congregation;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:insertPublishersNextWeekDate';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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

        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 1)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -7 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 2)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -8 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 3)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -9 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 4)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -10 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 5)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -11 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 6)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -12 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 7)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -13 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
    }
}
