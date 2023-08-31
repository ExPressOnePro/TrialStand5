<?php

namespace App\Http\Controllers\Stand;

use App\Http\Controllers\Controller;
use App\Http\Requests\StandPublishersRequest;
use App\Http\Requests\StandPublishersUpdateRequest;
use App\Models\StandPublishers;
use App\Models\StandPublishersHistory;
use App\Models\StandTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

class StandPublishersController extends Controller
{
    public function store(StandPublishersRequest $request): JsonResource
    {
        $standPublishers = StandPublishers::query()->create([
            'stand_template_id' => $request->standTemplateId,
            'time' => $request->time,
            'user_1' => $request->publisher,
            'user_2' => $request->partner,
            'date' => now(),
        ]);

        return new JsonResource($standPublishers);
    }

    public function update(StandPublishersUpdateRequest $request, int $id): JsonResource
    {
        $standPublishers = StandPublishers::query()->findOrFail($id);

        $update = [];

        if ($request->publisher) {
            $update['user_1'] = $request->publisher;
        }

        if ($request->partner) {
            $update['user_2'] = $request->partner;
        }

        if ($request->time) {
            $update['time'] = $request->time;
        }

        $standPublishers->update($update);

        return new JsonResource($standPublishers);
    }

    public function destroy(int $id): JsonResponse
    {
        StandPublishers::destroy($id);

        return Response::json(['message' => 'Stand record was deleted.']);
    }


    public function NewRecordStand1(Request $request) {

        $user_1 = $request->input('user_1');
        $date = $request->input('date1');
        $day = $request->input('day1');
        $time = $request->input('time1');
        $stand_template_id = $request->input('stand_template_id1');

        $new = StandPublishers::firstOrCreate([
            'date' => $date,
            'day' => $day,
            'time' => $time,
            'stand_template_id' => $stand_template_id,
            'publishers' => json_encode([
                'user_1' => $user_1,
                'user_2' => "",
                'user_3' => "",
                'user_4' => "",
            ]),
        ]);

        $stand_template = StandTemplate::find($stand_template_id);

        $StandPublishersHistory = new StandPublishersHistory();
        $StandPublishersHistory->publishers = json_encode([
            'user_1' => $user_1,
            'user_2' => "",
            'user_3' => "",
            'user_4' => "",
        ]);
        $StandPublishersHistory->date = $date;
        $StandPublishersHistory->day = $day;
        $StandPublishersHistory->time = $time;
        $StandPublishersHistory->stand_publishers_id = $new->id;
        $StandPublishersHistory->save();

        if($stand_template->type === 'current') {
            return redirect()->route('currentWeekTableFront', ['id' => $stand_template->stand_id])
                ->with('success','Вы успешно записаны');
        } else {
            return redirect()->route('nextWeekTableFront', ['id' => $stand_template->stand_id])
                ->with('success','Вы успешно записаны');
        }
    }

    public function AddPublisherToStand1(Request $request, $id) {

        $user_id1 = $request->input('1_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $StandPublisher->id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_2'] != $user_id1) {

            $StandPublishersHistory->publishers = json_encode([
                'user_1' => $user_id1,
                'user_2' => $publishers['user_2'],
                'user_3' => $publishers['user_3'],
                'user_4' => $publishers['user_4'],
            ]);
            $StandPublishersHistory->save();
            $StandPublisher->publishers = json_encode([
                'user_1' => $user_id1,
                'user_2' => $publishers['user_2'],
                'user_3' => $publishers['user_3'],
                'user_4' => $publishers['user_4'],
            ]);
            $StandPublisher->save();

            if($stand_full->type != 'next') {
                return redirect()->route('currentWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            } else {
                return redirect()->route('nextWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    public function AddPublisherToStand2(Request $request, $id) {
        $user_id2 = $request->input('2_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $StandPublisher->id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_1'] != $user_id2) {

            $StandPublishersHistory->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $user_id2,
                'user_3' => $publishers['user_3'],
                'user_4' => $publishers['user_4'],
            ]);
            $StandPublishersHistory->save();
            $StandPublisher->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $user_id2,
                'user_3' => $publishers['user_3'],
                'user_4' => $publishers['user_4'],
            ]);
            $StandPublisher->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    public function AddPublisherToStand3(Request $request, $id) {
        $user_id3 = $request->input('3_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $StandPublisher->id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_1'] != $user_id3 && $publishers['user_2'] != $user_id3) {

            $StandPublishersHistory->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $publishers['user_2'],
                'user_3' => $user_id3,
                'user_4' => $publishers['user_4'],
            ]);
            $StandPublishersHistory->save();
            $StandPublisher->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $publishers['user_2'],
                'user_3' => $user_id3,
                'user_4' => $publishers['user_4'],
            ]);
            $StandPublisher->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    public function AddPublisherToStand4(Request $request, $id) {
        $user_id4 = $request->input('4_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $StandPublisher->id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_1'] != $user_id4 && $publishers['user_2'] != $user_id4 && $publishers['user_3'] != $user_id4) {

            $StandPublishersHistory->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $publishers['user_2'],
                'user_3' => $publishers['user_3'],
                'user_4' => $user_id4,
            ]);
            $StandPublishersHistory->save();
            $StandPublisher->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $publishers['user_2'],
                'user_3' => $publishers['user_3'],
                'user_4' => $user_id4,
            ]);
            $StandPublisher->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    /*выписаться со стенда*/

    public function recordRedactionDelete1($id, $stand) {
        $standPublisher = StandPublishers::findOrFail($id);
        $standPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();

        $publishers = json_decode($standPublisher->publishers, true);
        $user2Value = $publishers['user_2'] ?? '';
        $user3Value = $publishers['user_3'] ?? '';
        $user4Value = $publishers['user_4'] ?? '';
        $standPublishersHistory->publishers = json_encode([
            'user_1' => "",
            'user_2' => $user2Value,
            'user_3' => $user3Value,
            'user_4' => $user4Value,
        ]);
        $standPublishersHistory->save();

        $standPublisher->publishers = $standPublishersHistory->publishers;
        $standPublisher->save();

        $stand_full = StandTemplate::find($standPublisher->stand_template_id);

        $publisher = json_decode($standPublisher->publishers, true);
        if (empty($publisher['user_1']) && empty($publisher['user_2']) && empty($publisher['user_3']) && empty($publisher['user_4'])) {
            $standPublisher->delete();
            $standPublishersHistory->delete();
        }

        $routeName = ($stand_full->type == 'next') ? 'nextWeekTableFront' : 'currentWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand]);
    }
    public function recordRedactionDelete2($id, $stand) {

        $StandPublisher = StandPublishers::findOrFail($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();

        $publishers = json_decode($StandPublisher->publishers, true);
        $user1Value = $publishers['user_1'] ?? '';
        $user3Value = $publishers['user_3'] ?? '';
        $user4Value = $publishers['user_4'] ?? '';
        $StandPublishersHistory->publishers = json_encode([
            'user_1' => $user1Value,
            'user_2' => "",
            'user_3' => $user3Value,
            'user_4' => $user4Value,
        ]);
        $StandPublishersHistory->save();

        $StandPublisher->publishers = $StandPublishersHistory->publishers;
        $StandPublisher->save();

        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        $publisher = json_decode($StandPublisher->publishers, true);
        if (empty($publisher['user_1']) && empty($publisher['user_2']) && empty($publisher['user_3']) && empty($publisher['user_4'])) {
            $StandPublisher->delete();
            $StandPublishersHistory->delete();
        }

        $routeName = ($stand_full->type == 'next') ? 'nextWeekTableFront' : 'currentWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand]);

        /*return redirect()->route('StandTable',  $id);*/
    }
    public function recordRedactionDelete3($id, $stand) {

        $StandPublisher = StandPublishers::findOrFail($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();

        $publishers = json_decode($StandPublisher->publishers, true);
        $user1Value = $publishers['user_1'] ?? '';
        $user2Value = $publishers['user_2'] ?? '';
        $user4Value = $publishers['user_4'] ?? '';

        $StandPublishersHistory->publishers = json_encode([
            'user_1' => $user1Value,
            'user_2' => $user2Value,
            'user_3' => "",
            'user_4' => $user4Value,
        ]);
        $StandPublishersHistory->save();

        $StandPublisher->publishers = $StandPublishersHistory->publishers;
        $StandPublisher->save();

        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        $publisher = json_decode($StandPublisher->publishers, true);
        if (empty($publisher['user_1']) && empty($publisher['user_2']) && empty($publisher['user_3']) && empty($publisher['user_4'])) {
            $StandPublisher->delete();
            $StandPublishersHistory->delete();
        }

        $routeName = ($stand_full->type == 'next') ? 'nextWeekTableFront' : 'currentWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand]);

        /*return redirect()->route('StandTable',  $id);*/
    }
    public function recordRedactionDelete4($id, $stand) {

        $StandPublisher = StandPublishers::findOrFail($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();

        $publishers = json_decode($StandPublisher->publishers, true);
        $user1Value = $publishers['user_1'] ?? '';
        $user2Value = $publishers['user_2'] ?? '';
        $user3Value = $publishers['user_3'] ?? '';

        $StandPublishersHistory->publishers = json_encode([
            'user_1' => $user1Value,
            'user_2' => $user2Value,
            'user_3' => $user3Value,
            'user_4' => "",

        ]);
        $StandPublishersHistory->save();

        $StandPublisher->publishers = $StandPublishersHistory->publishers;
        $StandPublisher->save();

        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        $publisher = json_decode($StandPublisher->publishers, true);
        if (empty($publisher['user_1']) && empty($publisher['user_2']) && empty($publisher['user_3']) && empty($publisher['user_4'])) {
            $StandPublisher->delete();
            $StandPublishersHistory->delete();
        }

        $routeName = ($stand_full->type == 'next') ? 'nextWeekTableFront' : 'currentWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand]);

        /*return redirect()->route('StandTable',  $id);*/
    }
    /*Перезаписать пользователя на стенд*/

    public function recordRedactionChange1(Request $request, $id, $stand) {
        $value = $request->input('1_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if (!$StandPublisher) {
            // Handle the case when StandPublisher is not found
            return redirect()->route($stand_full->type . 'WeekTableFront', ['id' => $stand_full->stand_id])
                ->with('error', 'Запись не найдена!');
        }

        $publishers = json_decode($StandPublisher->publishers, true);
        $publishersHistory = json_decode($StandPublishersHistory->publishers, true);

        if ($publishers['user_2'] != $value && $publishers['user_3'] != $value && $publishers['user_4'] != $value) {
            $newPublishers = [
                'user_1' => $value,
                'user_2' => $publishers['user_2'],
                'user_3' => $publishers['user_3'],
                'user_4' => $publishers['user_4'],
            ];

            $StandPublishersHistory->publishers = json_encode($newPublishers);
            $StandPublishersHistory->save();

            $StandPublisher->publishers = json_encode($newPublishers);
            $StandPublisher->save();

            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id]);
        } else {
            $errorMessage = 'Пользователь уже записан в выбранное время и дату!';
            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id])
                ->with('error', $errorMessage);
        }
    }
    public function recordRedactionChange2(Request $request, $id, $stand) {
        $value = $request->input('2_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_1'] != $value && $publishers['user_3'] != $value && $publishers['user_4'] != $value) {
            $newPublishers = [
                'user_1' => $publishers['user_1'],
                'user_2' => $value,
                'user_3' => $publishers['user_3'],
                'user_4' => $publishers['user_4'],
            ];

            $StandPublishersHistory->publishers = json_encode($newPublishers);
            $StandPublishersHistory->save();

            $StandPublisher->publishers = json_encode($newPublishers);
            $StandPublisher->save();

            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id]);
        } else {
            $errorMessage = 'Пользователь уже записан в выбранное время и дату!';
            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id])
                ->with('error', $errorMessage);
        }
    }
    public function recordRedactionChange3(Request $request, $id, $stand) {
        $value = $request->input('3_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_1'] != $value && $publishers['user_2'] != $value && $publishers['user_4'] != $value) {
            $newPublishers = [
                'user_1' => $publishers['user_1'],
                'user_2' =>  $publishers['user_2'],
                'user_3' => $value,
                'user_4' => $publishers['user_4'],
            ];

            $StandPublishersHistory->publishers = json_encode($newPublishers);
            $StandPublishersHistory->save();

            $StandPublisher->publishers = json_encode($newPublishers);
            $StandPublisher->save();

            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id]);
        } else {
            $errorMessage = 'Пользователь уже записан в выбранное время и дату!';
            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id])
                ->with('error', $errorMessage);
        }
    }
    public function recordRedactionChange4(Request $request, $id, $stand) {
        $value = $request->input('4_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }
        if($publishers['user_1'] != $value && $publishers['user_2'] != $value && $publishers['user_3'] != $value) {
            $newPublishers = [
                'user_1' => $publishers['user_1'],
                'user_2' => $publishers['user_2'],
                'user_3' => $publishers['user_3'],
                'user_4' => $value,
            ];

            $StandPublishersHistory->publishers = json_encode($newPublishers);
            $StandPublishersHistory->save();

            $StandPublisher->publishers = json_encode($newPublishers);
            $StandPublisher->save();

            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id]);
        } else {
            $errorMessage = 'Пользователь уже записан в выбранное время и дату!';
            $routeName = $stand_full->type . 'WeekTableFront';
            return redirect()->route($routeName, ['id' => $stand_full->stand_id])
                ->with('error', $errorMessage);
        }
    }


}
