<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\MeetingSchedules;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingSchedulesController extends Controller {

    public function overview($congregation_id) {

        $type_day = 1-7;
        $array = [
            'responsible_users' => [
                'resp1' => [
                    'name' => 'Распорядитель улица',
                    'value' => 'Владислав Головенко',
                ],
                'resp2' => [
                    'name' => 'Распорядитель фое',
                    'value' => 'Владислав Головенко',
                ],
                'resp3' => [
                    'name' => 'Распорядитель зал',
                    'value' => 'Владислав Головенко',
                ],
                'resp4' => [
                    'name' => 'Распорядитель сцена',
                    'value' => 'Владислав Головенко',
                ],
                'resp5' => [
                    'name' => 'Аппаратура',
                    'value' => 'Владислав Головенко',
                ],
                'resp6' => [
                    'name' => 'Zoom',
                    'value' => 'Владислав Головенко',
                ],
            ],
            'treasures' => [
                'trea1' =>[
                    'name' => '1. Почему можно верить Богу, который обещает нам вечную жизнь',
                    'value' => 'Владислав Головенко',
                ],
                'trea2' =>[
                    'name' => '2. Духовные жемчужины',
                    'value' => 'Владислав Головенко',
                ],
                'trea3' =>[
                    'name' => '3. Чтение Библии',
                    'value' => 'Владислав Головенко',
                ],
            ],
            'field_ministry' => [
                'field1' =>[
                    'name' => '4. Начинайте разговор',
                    'value1' => 'Владислав Головенко',
                ],
                'field2' =>[
                    'name' => '5. Развивайте интерес',
                    'value1' => 'Владислав Головенко',
                    'value2' => 'Владислав Головенко',
                ],
                'field4' =>[
                    'name' => '6. Объясняйте свои взгляды',
                    'value1' => 'Владислав Головенко',
                    'value2' => 'Владислав Головенко',
                ],
            ],
            'living' => [
                'living1' =>[
                    'name' => '7. Готовы ли вы к ситуациям, в которых вам может потребоваться медицинская помощь?',
                    'value1' => 'Владислав Головенко',
                ],
                'living2' =>[
                    'name' => '8. Изучение Библии в собрании',
                    'value1' => 'Владислав Головенко',

                ],
            ],
        ];
        $array2 = [
            'chairman' => '1',
//
            'song_1' => '1',
//
            'Speech_10_min' => '1',
            'Spiritual_Pearls' => '1',
            'Bible_reading' => '1',
//
            'main_hall_video_1' => '1',
            'main_hall_conversation_1' => '1',
            'main_hall_conversation_2' => '1',
            'main_hall_conversation_3' => '1',
            'main_hall_conversation_4' => '1',
            'main_hall_bible_study_1' => '1',
            'main_hall_speech' => '1',
//
            'main_hall_conversation_leader_1' => '1',
            'main_hall_conversation_leader_2' => '1',
            'main_hall_conversation_leader_3' => '1',
            'main_hall_conversation_leader_4' => '1',
            'main_hall_bible_study_leader_1' => '1',
            'main_hall_publisher_speaks' => '1',

            'main_hall_conversation_helper_1' => '1',
            'main_hall_conversation_helper_2' => '1',
            'main_hall_conversation_helper_3' => '1',
            'main_hall_conversation_helper_4' => '1',
            'main_hall_bible_study_helper_1' => '1',
//
            'second_hall_video_1' => '1',
            'second_hall_conversation_1' => '1',
            'second_hall_conversation_2' => '1',
            'second_hall_conversation_3' => '1',
            'second_hall_conversation_4' => '1',
            'second_hall_bible_study_1' => '1',
            'second_hall_speech' => '1',

            'second_hall_conversation_leader_1' => '1',
            'second_hall_conversation_leader_2' => '1',
            'second_hall_conversation_leader_3' => '1',
            'second_hall_conversation_leader_4' => '1',
            'second_hall_bible_study_leader_1' => '1',
            'second_hall_publisher_speaks' => '1',

            'second_hall_conversation_helper_1' => '1',
            'second_hall_conversation_helper_2' => '1',
            'second_hall_conversation_helper_3' => '1',
            'second_hall_conversation_helper_4' => '1',
            'second_hall_bible_study_helper_1' => '1',
//
            'song_2' => '1',
//
            'christian_life_item_1' => '1',
            'christian_life_item_2' => '1',
            'christian_life_item_3' => '1',
            'christian_life_item_4' => '1',
            'bible_study_in_the_congregation' => '1',
//
            'song_3' => '1',
//
            ];

        $nextWeekStart = Carbon::now()->startOfWeek()->addWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->endOfWeek()->addWeek()->format('Y-m-d');

        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek()->format('Y-m-d');

        $congregation = Congregation::query()->find($congregation_id);

        $decodeCongregationInfo = json_decode($congregation->info, true);

        $weekday = date('l', strtotime("Sunday +{$decodeCongregationInfo['weekday']} days"));

        $weekdayTime = $decodeCongregationInfo['weekdayTime'];

        $dateForGivenWeekday = $thisWeekStart->copy()->addDays($decodeCongregationInfo['weekday'] - Carbon::SUNDAY)->format('d.m.Y');
        $formattedDate = $thisWeekStart->copy()->addDays($decodeCongregationInfo['weekday'] - Carbon::SUNDAY)->isoFormat('MMMM D, YYYY');
        $currentDay = Carbon::now()->format('Y-m-d');


        $b = Carbon::now()->startOfWeek()->format('Y-m-d') ." - ". Carbon::now()->endOfWeek()->format('Y-m-d');
        $resp = MeetingSchedules::query()->get();
//        $data = json_decode($resp->schedule, true);
//        $responsibles = $data['responsible_users'];


        $compact = compact(
            'resp',
//            'responsibles',
            'congregation',
            'weekday',
            'weekdayTime',
            'dateForGivenWeekday',
            'decodeCongregationInfo',
            'formattedDate',

        );

        return view ('BootstrapApp.Modules.meetingSchedule.overview', $compact);
    }

    public function create() {

        $array = [
            'entry_manager' => '1',
            'lobby_manager' => '2',
            'hall_manager' => '3',
            'scene_manager' => '4',
            'equipment_1_operator',
            'equipment_2_operator_zoom',
            'microphone_1',
            'microphone_2',
//
            'chairman',
//
            'song_1',
//
            'Speech_10_min',
            'Spiritual_Pearls',
            'Bible_reading',
//
            'main_hall_video_1',
            'main_hall_conversation_1',
            'main_hall_conversation_2',
            'main_hall_conversation_3',
            'main_hall_conversation_4',
            'main_hall_bible_study_1',
            'main_hall_speech',
//
            'main_hall_conversation_leader_1',
            'main_hall_conversation_leader_2',
            'main_hall_conversation_leader_3',
            'main_hall_conversation_leader_4',
            'main_hall_bible_study_leader_1',
            'main_hall_publisher_speaks',

            'main_hall_conversation_helper_1',
            'main_hall_conversation_helper_2',
            'main_hall_conversation_helper_3',
            'main_hall_conversation_helper_4',
            'main_hall_bible_study_helper_1',
//
            'second_hall_video_1',
            'second_hall_conversation_1',
            'second_hall_conversation_2',
            'second_hall_conversation_3',
            'second_hall_conversation_4',
            'second_hall_bible_study_1',
            'second_hall_speech',

            'second_hall_conversation_leader_1',
            'second_hall_conversation_leader_2',
            'second_hall_conversation_leader_3',
            'second_hall_conversation_leader_4',
            'second_hall_bible_study_leader_1',
            'second_hall_publisher_speaks',

            'second_hall_conversation_helper_1',
            'second_hall_conversation_helper_2',
            'second_hall_conversation_helper_3',
            'second_hall_conversation_helper_4',
            'second_hall_bible_study_helper_1',
//
            'song_2',
//
            'christian_life_item_1',
            'christian_life_item_2',
            'christian_life_item_3',
            'christian_life_item_4',
            'bible_study_in_the_congregation',
//
            'song_3',
//
        ];
        $array = [
            'responsible_users' => [
                'resp1' => [
                    'name' => 'Распорядитель улица',
                    'value' => 'Владислав Головенко',
                ],
                'resp2' => [
                    'name' => 'Распорядитель фое',
                    'value' => 'Владислав Головенко',
                ],
                'resp3' => [
                    'name' => 'Распорядитель зал',
                    'value' => 'Владислав Головенко',
                ],
                'resp4' => [
                    'name' => 'Распорядитель сцена',
                    'value' => 'Владислав Головенко',
                ],
                'resp5' => [
                    'name' => 'Аппаратура',
                    'value' => 'Владислав Головенко',
                ],
                'resp6' => [
                    'name' => 'Zoom',
                    'value' => 'Владислав Головенко',
                ],
            ],
            'treasures' => [
                'trea1' =>[
                    'name' => '1. Почему можно верить Богу, который обещает нам вечную жизнь',
                    'value' => 'Владислав Головенко',
                ],
                'trea2' =>[
                    'name' => '2. Духовные жемчужины',
                    'value' => 'Владислав Головенко',
                ],
                'trea3' =>[
                    'name' => '3. Чтение Библии',
                    'value' => 'Владислав Головенко',
                ],
            ],
            'field_ministry' => [
                'field1' =>[
                    'name' => '4. Начинайте разговор',
                    'value1' => 'Владислав Головенко',
                ],
                'field2' =>[
                    'name' => '5. Развивайте интерес',
                    'value1' => 'Владислав Головенко',
                    'value2' => 'Владислав Головенко',
                ],
                'field4' =>[
                    'name' => '6. Объясняйте свои взгляды',
                    'value1' => 'Владислав Головенко',
                    'value2' => 'Владислав Головенко',
                ],
            ],
            'living' => [
                'living1' =>[
                    'name' => '7. Готовы ли вы к ситуациям, в которых вам может потребоваться медицинская помощь?',
                    'value1' => 'Владислав Головенко',
                ],
                'living2' =>[
                    'name' => '8. Изучение Библии в собрании',
                    'value1' => 'Владислав Головенко',

                ],
            ],
        ];

        $resp = MeetingSchedules::query()->find(1);
        $data = json_decode($resp->schedule, true);
        $responsibles = $data['responsible_users'];


        $compact = compact(
            'responsibles',
        );
        return view ('BootstrapApp.Modules.meetingSchedule.create', $compact);
    }

    public function save_responsibles(Request $request)
    {
        $responsibles = $request->input('responsibles');

        MeetingSchedules::where('congregation_id', 2)
        ->update([
            'congregation_id' => 2,
            'start_of_week' => '2024-01-15',
            'end_of_week' => '2024-01-21',
            'type_day' => 1,
            'schedule->responsible_users' =>  $responsibles,
        ]);

        return redirect()->back();
    }

}
