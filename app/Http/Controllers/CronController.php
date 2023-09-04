<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\StandPublishers;
use Illuminate\Http\Request;

class CronController extends Controller
{
    public function publishersUpdateThisWeekFromNextWeekVersion1($token) {

        $expectedToken = 'aBcD1234EfGh5678iJkLmN9oPqRsT0123uVwXyZ';

        if ($token === $expectedToken) {
            $congregations = Congregation::with('stand')->get();

            foreach ($congregations as $congregation) {
                foreach ($congregation->stand as $stand) {
                    $stand_template_id_next = $stand->standTemplate()->where('type', 'next')->first();
                    $stand_template_id_current = $stand->standTemplate()->where('type', 'current')->first();

                    if ($stand_template_id_current) {
                        StandPublishers::where('stand_template_id', $stand_template_id_current->id)->delete();
                    }

                    if ($stand_template_id_next) {
                        StandPublishers::where('stand_template_id', $stand_template_id_next->id)
                            ->update([
                                'stand_template_id' => optional($stand_template_id_current)->id
                            ]);
                    }
                }
            }
            return "Задача cron выполнена успешно.";
        } else {
            return "Доступ запрещен.";
        }

    }
}
