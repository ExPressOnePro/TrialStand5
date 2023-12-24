<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingSchedulesController extends Controller {

    public function overview() {

        $type_day = 1-7;
        $congregation_id = 1;
        $schedule = [
            'entry_manager' => '1',
            'lobby_manager' => '1',
            'hall_manager' => '1',
            'scene_manager' => '1',
            'equipment_1_operator' => '1',
            'equipment_2_operator_zoom' => '1',
            'microphone_1' => '1',
            'microphone_2' => '1',
//
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

        $thisWeekStart = Carbon::now()->startOfWeek()->format('Y-m-d');
        $thisWeekEnd = Carbon::now()->endOfWeek()->format('Y-m-d');


        $a = $nextWeekStart ." - ". $nextWeekEnd;
        $c = $nextWeekStart ." - ". $nextWeekEnd;

        $b = $thisWeekStart ." - ". $thisWeekEnd;

        // Получаем текущую дату
        $currentDay = Carbon::now()->format('Y-m-d');


        $b = Carbon::now()->startOfWeek()->format('Y-m-d') ." - ". Carbon::now()->endOfWeek()->format('Y-m-d');


        // Проверяем, находится ли текущий день в диапазоне
        if ($currentDay >=  $b && $currentDay <=  $b) {

        } else {

        }


        $entry_manager = User::find($array['entry_manager']);
        $lobby_manager = User::find($array['lobby_manager']);
        $hall_manager = User::find($array['hall_manager']);
        $scene_manager = User::find($array['scene_manager']);
        $equipment_1_operator  =  User::find($array['equipment_1_operator']);
        $equipment_2_operator_zoom  =  User::find($array['equipment_2_operator_zoom']);
        $microphone_1  =  User::find($array['microphone_1']);
        $microphone_2  =  User::find($array['microphone_2']);

        $chairman  =  User::find($array['chairman']);

        $song_1  =  User::find($array['song_1']);

        $Speech_10_min  =  User::find($array['Speech_10_min']);
        $Spiritual_Pearls  =  User::find($array['Spiritual_Pearls']);
        $Bible_reading  =  User::find($array['Bible_reading']);

        $main_hall_video_1  =  User::find($array['main_hall_video_1']);
        $main_hall_conversation_1  =  User::find($array['main_hall_conversation_1']);
        $main_hall_conversation_2  =  User::find($array['main_hall_conversation_2']);
        $main_hall_conversation_3  =  User::find($array['main_hall_conversation_3']);
        $main_hall_conversation_4  =  User::find($array['main_hall_conversation_4']);
        $main_hall_bible_study_1  =  User::find($array['main_hall_bible_study_1']);
        $main_hall_speech  =  User::find($array['main_hall_speech']);

        $main_hall_conversation_leader_1  =  User::find($array['main_hall_conversation_leader_1']);
        $main_hall_conversation_leader_2  =  User::find($array['main_hall_conversation_leader_2']);
        $main_hall_conversation_leader_3  =  User::find($array['main_hall_conversation_leader_3']);
        $main_hall_conversation_leader_4  =  User::find($array['main_hall_conversation_leader_4']);
        $main_hall_bible_study_leader_1  =  User::find($array['main_hall_bible_study_leader_1']);
        $main_hall_publisher_speaks  =  User::find($array['main_hall_publisher_speaks']);

        $main_hall_conversation_helper_1  =  User::find($array['main_hall_conversation_helper_1']);
        $main_hall_conversation_helper_2  =  User::find($array['main_hall_conversation_helper_2']);
        $main_hall_conversation_helper_3  =  User::find($array['main_hall_conversation_helper_3']);
        $main_hall_conversation_helper_4  =  User::find($array['main_hall_conversation_helper_4']);
        $main_hall_bible_study_helper_1  =  User::find($array['main_hall_bible_study_helper_1']);

        $second_hall_video_1  =  User::find($array['second_hall_video_1']);
        $second_hall_conversation_1  =  User::find($array['second_hall_conversation_1']);
        $second_hall_conversation_2  =  User::find($array['second_hall_conversation_2']);
        $second_hall_conversation_3  =  User::find($array['second_hall_conversation_3']);
        $second_hall_conversation_4  =  User::find($array['second_hall_conversation_4']);
        $second_hall_bible_study_1  =  User::find($array['second_hall_bible_study_1']);
        $second_hall_speech  =  User::find($array['second_hall_speech']);

        $second_hall_conversation_leader_1  =  User::find($array['second_hall_conversation_leader_1']);
        $second_hall_conversation_leader_2  =  User::find($array['second_hall_conversation_leader_2']);
        $second_hall_conversation_leader_3  =  User::find($array['second_hall_conversation_leader_3']);
        $second_hall_conversation_leader_4  =  User::find($array['second_hall_conversation_leader_4']);
        $second_hall_bible_study_leader_1  =  User::find($array['second_hall_bible_study_leader_1']);
        $second_hall_publisher_speaks  =  User::find($array['second_hall_publisher_speaks']);

        $second_hall_conversation_helper_1  =  User::find($array['second_hall_conversation_helper_1']);
        $second_hall_conversation_helper_2  =  User::find($array['second_hall_conversation_helper_2']);
        $second_hall_conversation_helper_3  =  User::find($array['second_hall_conversation_helper_3']);
        $second_hall_conversation_helper_4  =  User::find($array['second_hall_conversation_helper_4']);
        $second_hall_bible_study_helper_1  =  User::find($array['second_hall_bible_study_helper_1']);

        $song_2  =  User::find($array['song_2']);

        $christian_life_item_1  =  User::find($array['christian_life_item_1']);
        $christian_life_item_2  =  User::find($array['christian_life_item_2']);
        $christian_life_item_3  =  User::find($array['christian_life_item_3']);
        $christian_life_item_4  =  User::find($array['christian_life_item_4']);
        $bible_study_in_the_congregation  =  User::find($array['bible_study_in_the_congregation']);

        $song_3  =  User::find($array['song_3']);


        $responsible_users = [
            'entry_manager' => $entry_manager,
            'lobby_manager' => $lobby_manager,
            'hall_manager' => $hall_manager,
            'scene_manager' => $scene_manager,

            'equipment_1_operator' =>  $equipment_1_operator ,
            'equipment_2_operator_zoom' =>  $equipment_2_operator_zoom ,
            'microphone_1' =>  $microphone_1 ,
            'microphone_2' =>  $microphone_2 ,
            'chairman' =>  $chairman ,
            'song_1' =>  $song_1 ,

            'Speech_10_min' =>  $Speech_10_min ,
            'Spiritual_Pearls' =>  $Spiritual_Pearls ,
            'Bible_reading' =>  $Bible_reading ,

            'main_hall_video_1' =>  $main_hall_video_1 ,
            'main_hall_conversation_1' =>  $main_hall_conversation_1 ,
            'main_hall_conversation_2' =>  $main_hall_conversation_2 ,
            'main_hall_conversation_3' =>  $main_hall_conversation_3 ,
            'main_hall_conversation_4' =>  $main_hall_conversation_4 ,
            'main_hall_bible_study_1' =>  $main_hall_bible_study_1 ,
            'main_hall_speech' =>  $main_hall_speech ,

            'main_hall_conversation_leader_1'=>  $main_hall_conversation_leader_1 ,
            'main_hall_conversation_leader_2'=>  $main_hall_conversation_leader_2 ,
            'main_hall_conversation_leader_3'=>  $main_hall_conversation_leader_3 ,
            'main_hall_conversation_leader_4'=>  $main_hall_conversation_leader_4 ,
            'main_hall_bible_study_leader_1'=>  $main_hall_bible_study_leader_1 ,
            'main_hall_publisher_speaks'=>  $main_hall_publisher_speaks ,

            'main_hall_conversation_helper_1'=>  $main_hall_conversation_helper_1 ,
            'main_hall_conversation_helper_2'=>  $main_hall_conversation_helper_2 ,
            'main_hall_conversation_helper_3'=>  $main_hall_conversation_helper_3 ,
            'main_hall_conversation_helper_4'=>  $main_hall_conversation_helper_4 ,
            'main_hall_bible_study_helper_1'=>  $main_hall_bible_study_helper_1 ,

            'second_hall_video_1'=>  $second_hall_video_1 ,
            'second_hall_conversation_1'=>  $second_hall_conversation_1 ,
            'second_hall_conversation_2'=>  $second_hall_conversation_2 ,
            'second_hall_conversation_3'=>  $second_hall_conversation_3 ,
            'second_hall_conversation_4'=>  $second_hall_conversation_4 ,
            'second_hall_bible_study_1'=>  $second_hall_bible_study_1 ,
            'second_hall_speech'=>  $second_hall_speech ,

            'second_hall_conversation_leader_1'=> $second_hall_conversation_leader_1 ,
            'second_hall_conversation_leader_2'=> $second_hall_conversation_leader_2 ,
            'second_hall_conversation_leader_3'=> $second_hall_conversation_leader_3 ,
            'second_hall_conversation_leader_4'=> $second_hall_conversation_leader_4 ,
            'second_hall_bible_study_leader_1'=> $second_hall_bible_study_leader_1 ,
            'second_hall_publisher_speaks'=> $second_hall_publisher_speaks ,

            'second_hall_conversation_helper_1'=> $second_hall_conversation_helper_1 ,
            'second_hall_conversation_helper_2'=> $second_hall_conversation_helper_2 ,
            'second_hall_conversation_helper_3'=> $second_hall_conversation_helper_3 ,
            'second_hall_conversation_helper_4'=> $second_hall_conversation_helper_4 ,
            'second_hall_bible_study_helper_1'=> $second_hall_bible_study_helper_1 ,

            'song_2' => $song_2,

            'christian_life_item_1'=>  $christian_life_item_1 ,
            'christian_life_item_2'=>  $christian_life_item_2 ,
            'christian_life_item_3'=>  $christian_life_item_3 ,
            'christian_life_item_4'=>  $christian_life_item_4 ,
            'bible_study_in_the_congregation'=>  $bible_study_in_the_congregation ,

            'song_3' => $song_3 ,


        ];

        return view ('Mobile.menu.modules.meetingSchedules.overview', compact('array', 'responsible_users'));
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
    }
}
