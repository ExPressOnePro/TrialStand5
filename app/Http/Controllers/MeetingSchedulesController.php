<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\MeetingSchedules;
use App\Models\MeetingScheduleTemplate;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class MeetingSchedulesController extends Controller {

    public function overview($congregation_id) {
        $congregation = Congregation::query()->find($congregation_id);
        $congregationInfo = json_decode($congregation->info,true);
        $meeting_schedule_templates = MeetingScheduleTemplate::query()->where('congregation_id', $congregation_id)->get();
        $meetingSchedules = MeetingSchedules::query()->with('meetingScheduleTemplate')->orderBy('date', 'desc')->get();
        $weeklySchedule = [];
        foreach ($meetingSchedules as $meetingSchedule) {
            // Определение ключа (уникальный идентификатор недели) для записи
            $weekKey = 'week_' . Carbon::parse($meetingSchedule->date)->weekOfYear;

            // Добавление записи в массив с ключом
            if (!isset($weeklySchedule[$weekKey])) {
                $weeklySchedule[$weekKey] = [
                    'week_start' => Carbon::parse($meetingSchedule->date)->startOfWeek()->isoFormat('D'),
                    'week_end' => Carbon::parse($meetingSchedule->date)->endOfWeek()->isoFormat('D MMM, YYYY'),
                    'weekday_schedule' => null,
                    'weekend_schedule' => null,
//                    'weekday' => Carbon::createFromTime($congregationInfo['weekday'], 0, 0)->isoFormat('dddd'),
//                    'weekend' => Carbon::createFromTime($congregationInfo['weekend'], 0, 0)->isoFormat('dddd'),
                    'weekday_time' => $congregationInfo['weekdayTime'],
                    'weekend_time' => $congregationInfo['weekendTime'],
                ];
            }

            // Определение дня недели
            $dayOfWeek = Carbon::parse($meetingSchedule->date)->dayOfWeek;
            $scheduleData = [
                'id' => $meetingSchedule->id,
                'date' => Carbon::parse($meetingSchedule->date)->isoFormat('MMMM D, YYYY'),
                'template_name' => $meetingSchedule->meetingScheduleTemplate->template_name,
            ];

            // Добавление расписания в соответствующий подмассив (будние или выходные)
            if ($dayOfWeek >= Carbon::MONDAY && $dayOfWeek <= Carbon::FRIDAY) {
                $weeklySchedule[$weekKey]['weekday_schedule'] = $scheduleData;
            } else {
                $weeklySchedule[$weekKey]['weekend_schedule'] = $scheduleData;
            }
        }
        $weeklySchedule = array_values($weeklySchedule);

//        dd($weeklySchedule);


        $compact = compact(
            'congregation',
            'meeting_schedule_templates',
            'weeklySchedule',


        );

        return view ('BootstrapApp.Modules.meetingSchedule.overview', $compact);
    }

    public function create(Request $request, $congregation_id, $ms_template_id) {

        $inputdate = $request->input('dateInput');
        $ms_template = MeetingScheduleTemplate::query()->find($ms_template_id);

        if ($ms_template) {
            $meetingSchedule = new MeetingSchedules();
            $meetingSchedule->ms_template_id = $ms_template_id;
            $meetingSchedule->date = $inputdate;
            $meetingSchedule->schedule = $ms_template->template;
            $meetingSchedule->save();
        }

        $resp = MeetingSchedules::query()->find($meetingSchedule->id);
        $data = json_decode($resp->schedule, true);
        $responsibles = $data['responsible_users'];


        $compact = compact(
            'responsibles',
        );
        return view ('BootstrapApp.Modules.meetingSchedule.create', $compact);
    }

    public function schedule($id) {

        $ms = MeetingSchedules::query()->find($id);

        $data = json_decode($ms->schedule, true);
        $compact = compact(
            'data',
            'ms',
        );
        return view ('BootstrapApp.Modules.meetingSchedule.week_schedule', $compact);
    }
    public function redaction($id) {

        $ms = MeetingSchedules::query()->find($id);

        $data = json_decode($ms->schedule, true);
        $responsibles = $data['responsible_users'];
        $treasures = $data['treasures'];
        $fieldMinistry  = $data['field_ministry'];
        $living  = $data['living'];
        $songs  = $data['songs'];


        $compact = compact(
            'data',
            'responsibles',
            'fieldMinistry',
            'treasures',
            'living',
            'songs',
            'ms',
        );
        if (date('N', strtotime($ms->date)) < 6) {
            return view ('BootstrapApp.Modules.meetingSchedule.redaction_weekday', $compact);
        } else {
            return view ('BootstrapApp.Modules.meetingSchedule.redaction_weekend', $compact);
        }

    }

    public function save_responsibles(Request $request, $id)
    {
        $responsibles = $request->input('responsibles');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['responsible_users'] = $responsibles;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_treasures(Request $request, $id)
    {
        $treasures = $request->input('treasures');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['treasures'] = $treasures;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_field_ministry(Request $request, $id)
    {
        $field_ministry = $request->input('field_ministry');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['field_ministry'] = $field_ministry;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_living(Request $request, $id)
    {
        $living = $request->input('living');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['living'] = $living;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_songs(Request $request, $id)
    {
        $songs = $request->input('songs');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['songs'] = $songs;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }


}
