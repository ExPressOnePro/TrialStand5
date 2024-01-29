<?php

namespace App\Http\Controllers;


use App\Models\Congregation;
use App\Models\MeetingSchedules;
use App\Models\MeetingScheduleTemplate;
use App\Models\User;
use App\Services\MeetingSchedulesService;
use App\Services\UserService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingSchedulesController extends Controller {

    public function overview($congregation_id) {
        $congregation = Congregation::query()->find($congregation_id);
        $meeting_schedule_templates = MeetingScheduleTemplate::query()->where('congregation_id', $congregation_id)->get();
        $meetingSchedules = MeetingSchedules::query()
            ->with('meetingScheduleTemplate')
            ->whereHas('meetingScheduleTemplate', function ($query) use ($congregation_id) {
                $query->where('congregation_id', $congregation_id);
            })
            ->orderBy('week_from', 'desc'
            )->get();

        $weeklySchedule = [];
        foreach ($meetingSchedules as $meetingSchedule) {
            // Определение ключа (уникальный идентификатор недели) для записи
            $weekKey = 'week_' . Carbon::parse($meetingSchedule->week_from)->weekOfYear;
            $dayOfWeek = Carbon::parse($meetingSchedule->week_from)->dayOfWeek;
            $meetingScheduleWeekdayTime = Carbon::parse($meetingSchedule->weekday_time)->isoFormat('D MMM YYYY, dddd HH:mm');
            $meetingScheduleWeekendTime = Carbon::parse($meetingSchedule->weekend_time)->isoFormat('D MMM YYYY, dddd HH:mm');
            // Добавление записи в массив с ключом
            if (!isset($weeklySchedule[$weekKey])) {
                $weeklySchedule[$weekKey] = [
                    'id' => $meetingSchedule->id,
                    'week_start' => Carbon::parse($meetingSchedule->week_from)->startOfWeek()->isoFormat('D'),
                    'week_end' => Carbon::parse($meetingSchedule->week_from)->endOfWeek()->isoFormat('D MMM, YYYY'),
                    'weekday' => $meetingScheduleWeekdayTime,
                    'weekend' => $meetingScheduleWeekendTime,
                    'template_name' => $meetingSchedule->meetingScheduleTemplate->template_name,
                    'updated' => $meetingSchedule->updated_at->isoformat('D MMM YYYY, HH:mm'),
                    'published' => $meetingSchedule->published,
                    'deleted' => $meetingSchedule->deleted,
                ];
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

    public function create(Request $request, $congregation_id) {
        $inputdate = $request->input('weekPicker');
        $ms_template_id = $request->input('ms_template_id');
        $startDate = Carbon::parse($inputdate)->startOfWeek();

        // Проверка на существование записи в шаблонах
        $existingTemplate = MeetingSchedules::with('meetingScheduleTemplate')
            ->whereHas('meetingScheduleTemplate', function ($query) use ($congregation_id) {
                $query->where('congregation_id', $congregation_id);
            })
            ->where('week_from', $startDate)
            ->first();

        if ($existingTemplate) {
            return redirect()->route('meetingSchedules.overview', $congregation_id)
                ->with('error', 'Расписание уже существует для выбранной недели!');
        }
        $congregation = Congregation::query()->find($congregation_id);
        $congregationInfo = json_decode($congregation->info,true);
        $weekdayTime = $congregationInfo['weekdayTime'];
        $weekendTime = $congregationInfo['weekendTime'];
        $weekday = $congregationInfo['weekday'];
        $weekend = $congregationInfo['weekend'];

        $weekdayDateTime = $startDate->copy()->addDays($weekday - 1)->setTimeFromTimeString($weekdayTime);
        $weekendDateTime = $startDate->copy()->addDays($weekend - 1)->setTimeFromTimeString($weekendTime);


        $ms_template = MeetingScheduleTemplate::query()->find($ms_template_id);

        if ($ms_template) {
            $meetingSchedule = new MeetingSchedules();
            $meetingSchedule->week_from = $startDate;
            $meetingSchedule->weekday_time = $weekdayDateTime;
            $meetingSchedule->weekend_time = $weekendDateTime;
            $meetingSchedule->ms_template_id = $ms_template_id;
            $meetingSchedule->schedule = $ms_template->template;
            $meetingSchedule->save();
        }

        return redirect()->route('meetingSchedules.redaction', $meetingSchedule->id);
    }

    public function redaction($id) {

        $ms = MeetingSchedules::query()->with('meetingScheduleTemplate')->find($id);
        $formattedUsers = User::query()
            ->where('congregation_id', $ms->meetingScheduleTemplate->congregation_id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->orderBy('last_name', 'asc')
            ->get();

        $users = $formattedUsers->map(function ($user) {
            return [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ];
        });


        $data = json_decode($ms->schedule, true);

        // Check if 'weekday' key exists and is an array
        $responsibles = $data['weekday']['responsible_users'] ?? [];
        $treasures = $data['weekday']['treasures'] ?? [];
        $fieldMinistry = $data['weekday']['field_ministry'] ?? [];
        $living = $data['weekday']['living'] ?? [];
        $songs = $data['weekday']['songs'] ?? [];

        // Check if 'weekend' key exists and is an array
        $responsibles_weekend = $data['weekend']['responsible_users'] ?? [];
        $public_speech = $data['weekend']['public_speech'] ?? [];
        $watchtower = $data['weekend']['watchtower'] ?? [];
        $songs_weekend = $data['weekend']['songs'] ?? [];

        $compact = compact(
            'users',
            'data',
            'responsibles',
            'responsibles_weekend',
            'public_speech',
            'watchtower',
            'songs_weekend',
            'fieldMinistry',
            'treasures',
            'living',
            'songs',
            'ms',
        );

        return view('BootstrapApp.Modules.meetingSchedule.redaction_weekday', $compact);
    }

    public function publish($id)
    {
        $schedule = MeetingSchedules::findOrFail($id);
        $schedule->published = !$schedule->published;
        $schedule->save();
        // Дополнительная логика, если необходимо
        return redirect()->back();
    }

    public function delete($id)
    {
        $schedule = MeetingSchedules::findOrFail($id);
        $schedule->deleted = !$schedule->deleted;
        $schedule->save();
        // Дополнительная логика, если необходимо
        return redirect()->back();
    }

    public function schedule($id) {
        $AuthUserId = Auth::id();
        $ms = MeetingSchedules::query()->find($id);

        $data = $ms ? json_decode($ms->schedule, true) : [];
        $data = json_decode($ms->schedule, true);
        $treasures = $data['weekday']['treasures'] ?? [];

        $responsibles = $data['weekday']['responsible_users'] ?? [];
        $songs = $data['weekday']['songs'] ?? [];
        $songs_weekend = $data['weekend']['songs'] ?? [];
        $fieldMinistry = $data['weekday']['field_ministry'] ?? [];
        $living = $data['weekday']['living'] ?? [];

        $public_speech = $data['weekend']['public_speech'] ?? [];
        $watchtower = $data['weekend']['watchtower'] ?? [];
        $responsibles_weekend = $data['weekend']['responsible_users'] ?? [];

        $processedResponsibles = MeetingSchedulesService::processUsersData($responsibles);
        $processedSongs = MeetingSchedulesService::processUsersData($songs);
        $processedTreasures = MeetingSchedulesService::processUsersData($treasures);
        $processedFieldMinistry = MeetingSchedulesService::processUsersData($fieldMinistry);
        $processedLiving = MeetingSchedulesService::processUsersData($living);


        $processedSongs_weekend = MeetingSchedulesService::processUsersData($songs_weekend);
        $processedResponsiblesWeekend = MeetingSchedulesService::processUsersData($responsibles_weekend);
        $processedWatchtower = MeetingSchedulesService::processUsersData($watchtower);
        $processedPublicSpeech = MeetingSchedulesService::processUsersData($public_speech);


        $datas = [
            'weekday' => [
                'responsible_users' => $processedResponsibles?? [],
                'songs' => $processedSongs ?? [],
                'treasures' => $processedTreasures ?? [],
                'field_ministry' => $processedFieldMinistry ?? [],
                'living' => $processedLiving ?? [],
            ],
            'weekend'=> [
                'responsible_users' => $processedResponsiblesWeekend?? [],
                'songs' => $processedSongs_weekend ?? [],
                'public_speech' => $processedPublicSpeech ?? [],
                'watchtower' => $processedWatchtower ?? [],
            ]
        ];

//        dd($datas);

        $public_speech = $data['weekend']['public_speech'] ?? [];




        $compact = compact(
            'data',
            'AuthUserId',
            'datas',
            'ms',
        );
        return view ('BootstrapApp.Modules.meetingSchedule.week_schedule', $compact);
    }


    public function save_responsibles(Request $request, $id)
    {
        $responsibles = $request->input('responsibles');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekday']['responsible_users'] = $responsibles;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_responsibles_weekend(Request $request, $id)
    {
        $responsibles = $request->input('responsibles_weekend');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekend']['responsible_users'] = $responsibles;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_treasures(Request $request, $id)
    {
        $treasures = $request->input('treasures');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekday']['treasures'] = $treasures;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_field_ministry(Request $request, $id)
    {
        $field_ministry = $request->input('field_ministry');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekday']['field_ministry'] = $field_ministry;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_living(Request $request, $id)
    {
        $living = $request->input('living');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekday']['living'] = $living;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }

    public function save_songs(Request $request, $id)
    {
        $songs = $request->input('songs');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekday']['songs'] = $songs;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }

    public function save_songs_weekend(Request $request, $id)
    {
        $songs = $request->input('songs');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekend']['songs'] = $songs;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_public_speech(Request $request, $id)
    {
        $public_speech = $request->input('public_speech');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekend']['public_speech'] = $public_speech;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }
    public function save_watchtower(Request $request, $id)
    {
        $watchtower = $request->input('watchtower');
        $ms = MeetingSchedules::find($id);

        $schedule = json_decode($ms->schedule, true);
        $schedule['weekend']['watchtower'] = $watchtower;
        $ms->schedule = $schedule;
        $ms->save();

        return redirect()->back();
    }



}
