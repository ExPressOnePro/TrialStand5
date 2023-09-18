<?php

namespace App\Http\Controllers\Stand;

use App\Http\Controllers\Controller;
use App\Http\Requests\StandRequest;
use App\Models\Stand;
use App\Models\StandTemplate;
use Carbon\Carbon;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StandTemplateController extends Controller {
    public function index(StandRequest $request): JsonResource
    {
        $templates = StandTemplate::with([
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation',
        ])
            ->where([
                'congregation_id' => $request->congregationId,
                'stand_id' => $request->standId,
            ])
            ->orderBy('day')
            ->get();

        $currentWeek = $templates->where('type', 'current');
        $nextWeek = $templates->where('type', 'next');

        return JsonResource::collection([
            'current' => $currentWeek,
            'next' => $nextWeek,
        ]);
    }

    public function weekDays(): JsonResource
    {
        $now = Carbon::now();
        $currentWeekDay = $now->copy()->dayOfWeek;
        $weekStartDate = $now->copy()->startOfWeek()->format('d-m-Y');
        $weekEndDate = $now->copy()->endOfWeek()->format('d-m-Y');
        $nextWeekStartDate = $now->copy()->addWeek()->startOfWeek()->format('d-m-Y');
        $nextWeekEndDate = $now->copy()->addWeek()->endOfWeek()->format('d-m-Y');

        return new JsonResource([
            'currentNumberOfWeekDay' => $currentWeekDay,
            'currentWeekStartDate' => $weekStartDate,
            'currentWeekEndDate' => $weekEndDate,
            'nextWeekStartDate' => $nextWeekStartDate,
            'nextWeekEndDate' => $nextWeekEndDate,
        ]);
    }

    public function publishersAtStand(Request $request, $id)
    {
        $standTemplates = StandTemplate::where('stand_id', $id)->whereIn('type', ['current', 'next'])->get();

        foreach ($standTemplates as $standTemplate) {
            if ($standTemplate) {
                $settings = json_decode($standTemplate->settings, true);
                $settings['publishers_at_stand'] = $request->input('publishersAtStand');
                $standTemplate->settings = json_encode($settings);
                $standTemplate->save();
            }
        }

        return redirect()->back();
    }

    public function timeActivation(Request $request, $id){

        $stand_id = Stand::find($id);
        $congregation_id = $stand_id->congregation_id;


        $standTemplate = StandTemplate::where('type', 'next')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->first();

        if ($standTemplate) {
            $settings = json_decode($standTemplate->settings, true);

            // Замените ключи на соответствующие значения, которые вы хотите изменить
            $settings['activation'] = $request->input('dayOfWeek') .'-'.$request->input('time');


            $standTemplate->settings = json_encode($settings);
            $standTemplate->save();

        }

        return redirect()->back();
    }

    public function timeUpdateNext(Request $request, $id){


        $stand_id = Stand::find($id);
        $congregation_id = $stand_id->congregation_id;
        $template = StandTemplate::where('stand_id', $id)->where('type', '=','next')->first();
        $templateSchedule = $template->week_schedule;

        // Получите данные из формы
        $time = $request->input('time'); // Значение для записи
        $day = $request->input('day');   // Ключ, под которым нужно записать данные

        // Если есть часы для дня, то сохраните его в массиве, иначе удалите его из массива
        if (!empty($time)) {
            $templateSchedule[$day] = $time;
        } else {
            unset($templateSchedule[$day]);
        }
        // Преобразуйте массив JSON обратно в строку
        $updatedJsonString = json_encode($templateSchedule);


        StandTemplate::where('type', 'next')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->update([
                'week_schedule' => $updatedJsonString,
            ]);

        return redirect()->back();
    }

    public function StandTimeNextToCurrent($id) {

        $stand = Stand::find($id);
        $congregation_id = $stand->congregation_id;

        $week_schedule_next = StandTemplate::where('type', 'next')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->first();


        StandTemplate::where('type', 'current')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->update([
                'week_schedule' => $week_schedule_next->week_schedule,
            ]);

        return redirect()->back();
    }

}
