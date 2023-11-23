<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;


class CronController extends Controller
{
    public function handle()
    {
        try {
            // Ваш код для выполнения задачи
            $token = 'aBcD1234EfGh5678iJkLmN9oPqRsT0123uVwXyZ';

            $result = $this->publishersUpdateThisWeekFromNextWeekVersion1($token);

            if ($result === "Доступ запрещен.") {
                Log::channel('cron')->error('Доступ запрещен.');
            } else {
                Log::channel('cron')->info('Задача cron выполнена успешно.');
            }
        } catch (\Exception $e) {
            Log::channel('cron')->error('Произошла ошибка в Cron задании: ' . $e->getMessage());
        }
    }

    public function runCronTask($token) {
        $result = $this->publishersUpdateThisWeekFromNextWeekVersion1($token);

        if ($result === "Доступ запрещен.") {
            Log::channel('cron')->error('Доступ запрещен.');
        } else {
            Log::channel('cron')->info('Задача cron выполнена успешно.');
        }

        return response()->json(['status' => 'success']);
    }


//    public function publishersUpdateThisWeekFromNextWeekVersion1($token) {
//        try {
//        $expectedToken = 'aBcD1234EfGh5678iJkLmN9oPqRsT0123uVwXyZ';
//
//        if ($token === $expectedToken) {
//
//            $congregations = Congregation::with('stand')->get();
//
//            foreach ($congregations as $congregation) {
//                foreach ($congregation->stand as $stand) {
//                    $stand_template_id_next = $stand->standTemplate()->where('type', 'next')->first();
//                    $stand_template_id_current = $stand->standTemplate()->where('type', 'current')->first();
//
//
//                    if ($stand_template_id_next && $stand_template_id_current) {
//
//                        // Получаю week_schedule из stand_template_id_next
//                        $week_schedule_next = $stand_template_id_next->week_schedule;
//
//                        // Обновление week_schedule в stand_template_id_current
//                        $stand_template_id_current->update(['week_schedule' => $week_schedule_next]);
//
//                        // В этом моменте week_schedule в stand_template_id_current обновлен.
//                    }
//
//
////                    if ($stand_template_id_current) {
////                        StandPublishers::where('stand_template_id', $stand_template_id_current->id)->delete();
////                    }
//                    if ($stand_template_id_next) {
//                        StandPublishers::where('stand_template_id', $stand_template_id_next->id)
//                            ->update([
//                                'stand_template_id' => optional($stand_template_id_current)->id
//                            ]);
//                    }
//                }
//            }
//            return "Задача cron выполнена успешно.";
//        } else {
//            return "Доступ запрещен.";
//        }
//        } catch (\Exception $e) {
//            Log::channel('cron')->error('Произошла ошибка в функции publishersUpdateThisWeekFromNextWeekVersion1: ' . $e->getMessage());
//        }
//    }

    public function publishersUpdateThisWeekFromNextWeekVersion1($token) {
        try {
            $expectedToken = 'aBcD1234EfGh5678iJkLmN9oPqRsT0123uVwXyZ';

            if ($token === $expectedToken) {
                $congregations = Congregation::with('stand')->get();

                foreach ($congregations as $congregation) {
                    foreach ($congregation->stand as $stand) {
                        $stand_template_id_next = $stand->standTemplate()->where('type', 'next')->first();
                        $stand_template_id_current = $stand->standTemplate()->where('type', 'current')->first();

                        if ($stand_template_id_next && $stand_template_id_current) {
                            $week_schedule_next = $stand_template_id_next->week_schedule;
                            $stand_template_id_current->update(['week_schedule' => $week_schedule_next]);
                        }

                        if ($stand_template_id_next) {
                            StandPublishers::where('stand_template_id', $stand_template_id_next->id)
                                ->update([
                                    'stand_template_id' => optional($stand_template_id_current)->id
                                ]);
                        }
                    }
                }

                Log::channel('cron')->info('Задача cron выполнена успешно.');
                return "Задача cron выполнена успешно.";
            } else {
                Log::channel('cron')->error('Доступ запрещен.');
                return "Доступ запрещен.";
            }
        } catch (\Exception $e) {
            Log::channel('cron')->error('Произошла ошибка в функции publishersUpdateThisWeekFromNextWeekVersion1: ' . $e->getMessage());
        }
    }


}
