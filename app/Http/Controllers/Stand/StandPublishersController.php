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


    public function NewRecordStand(Request $request) {

        $user_1 = $request->input('user_1');
        $date = $request->input('date1');
        $day = $request->input('day1');
        $time = $request->input('time1');
        $stand_template_id = $request->input('stand_template_id1');
        $stand_template = StandTemplate::find($stand_template_id);

        $stand_template = StandTemplate::find($stand_template_id);

        // Распарсите JSON из settings и получите publishers_at_stand
        $settings = json_decode($stand_template->settings, true);
        $publishersCount = $settings['publishers_at_stand'];

        // Создайте массив для хранения данных о пользователях
        $publishersData = [];

        // Заполните массив нужным количеством полей
        for ($i = 1; $i <= $publishersCount; $i++) {
            // Генерируйте ключи в формате 'user_X', где X - номер пользователя
            $key = 'user_' . $i;

            // Инициализируйте каждого пользователя пустой строкой
            $publishersData[$key] = "";
        }

        // Присвойте значение $user_1 первому индексу 'user_1'
        $publishersData['user_1'] = $user_1;

        // Создайте запись в базе данных
        $new = StandPublishers::firstOrCreate([
            'date' => $date,
            'day' => $day,
            'time' => $time,
            'stand_template_id' => $stand_template_id,
            'publishers' => json_encode($publishersData),
        ]);


        $StandPublishersHistory = new StandPublishersHistory();

        $StandPublishersHistory->publishers = json_encode($publishersData);

        $StandPublishersHistory->date = $date;
        $StandPublishersHistory->day = $day;
        $StandPublishersHistory->time = $time;
        $StandPublishersHistory->stand_publishers_id = $new->id;
        $StandPublishersHistory->stand_id = $stand_template->stand_id;
        $StandPublishersHistory->save();

        $routeName = $stand_template->type === 'current' ? 'currentWeekTableFront' : 'nextWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand_template->stand_id])->with('success', 'Вы успешно записаны');
    }


    // May be BUG to do 😊
    public function AddPublisherToStand(Request $request, $id = null) {
        $user_id = $request->input('user_id');

        $standPublisher = StandPublishers::find($id);
        $standPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $standPublisher->id)->first();
        $stand_full = StandTemplate::find($standPublisher->stand_template_id);
        $standPublishersDecode = json_decode($standPublisher->publishers, true);

        $foundEmpty = false;
        foreach ($standPublishersDecode as $key => $value) {
            if ($value == $user_id) {
                $errorMessage = 'Пользователь уже записан в выбранное время и дату!';
                if ($stand_full->type == 'next') {
                    return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])->with('error', $errorMessage);
                } else {
                    return redirect()->route('currentWeekTableFront', ['id' => $stand_full->stand_id])->with('error', $errorMessage);
                }
            }

            if (empty($value) && !$foundEmpty) {
                $standPublishersDecode[$key] = $user_id;
                $standPublishersHistory->publishers = json_encode($standPublishersDecode);
                $standPublishersHistory->save();
                $foundEmpty = true;
            }
        }

        $standPublisher->publishers = $standPublishersHistory->publishers;
        $standPublisher->save();


        if (!$foundEmpty) {
            // Если не было найдено пустых значений, вы можете выполнить другие действия
        }

        if($stand_full->type != 'next') {
            return redirect()->route('currentWeekTableFront', ['id' => $stand_full->stand_id])
                ->with('success','Вы успешно записаны');
        } else {
            return redirect()->route('nextWeekTableFront',  ['id' => $stand_full->stand_id])
                ->with('success','Вы успешно записаны');
        }
    }


    /*выписаться со стенда*/
    public function recordRedactionDelete($id, $stand, $user_id) {
        $standPublisher = StandPublishers::findOrFail($id);
        $standPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();
        $publishers = json_decode($standPublisher->publishers, true);

        foreach ($publishers as $key => $value) {
            if($value === $user_id) {
                $publishers[$key] = "";
                $standPublishersHistory->publishers = json_encode($publishers);
                $standPublishersHistory->save();
                break;
            }
        }

        $standPublisher->publishers = $standPublishersHistory->publishers;
        $standPublisher->save();

        $stand_full = StandTemplate::find($standPublisher->stand_template_id);


        $allEmpty = true;
        foreach ($publishers as $key => $value) {
            if (!empty($value)) {
                $allEmpty = false;
                break;
            }
        }
        if ($allEmpty) {
            $standPublisher->delete();
            $standPublishersHistory->delete();
        }

        $routeName = ($stand_full->type == 'next') ? 'nextWeekTableFront' : 'currentWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand]);
    }


    /*Перезаписать пользователя на стенд*/

    public function recordRedactionChange(Request $request, $id, $user_id) {
        $user_id = $request->input('user_id');


        $standPublisher = StandPublishers::find($id);
        $standPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $standPublisher->id)->first();
        $stand_full = StandTemplate::find($standPublisher->stand_template_id);
        $standPublishersDecode = json_decode($standPublisher->publishers, true);

        $foundEmpty = false;
        foreach ($standPublishersDecode as $key => $value) {
            if ($value == $user_id) {
                $errorMessage = 'Пользователь уже записан в выбранное время и дату!';
                if ($stand_full->type == 'next') {
                    return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])->with('error', $errorMessage);
                } else {
                    return redirect()->route('currentWeekTableFront', ['id' => $stand_full->stand_id])->with('error', $errorMessage);
                }
            }

            if (empty($value) && !$foundEmpty) {
                $standPublishersDecode[$key] = $user_id;
                $standPublishersHistory->publishers = json_encode($standPublishersDecode);
                $standPublishersHistory->save();
                $foundEmpty = true;
            }
        }

        $standPublisher->publishers = $standPublishersHistory->publishers;
        $standPublisher->save();


        if (!$foundEmpty) {
            // Если не было найдено пустых значений, вы можете выполнить другие действия
        }

        if ($stand_full->type != 'next') {
            return redirect()->route('currentWeekTableFront', ['id' => $stand_full->stand_id])
                ->with('success', 'Вы успешно записаны');
        } else {
            return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                ->with('success', 'Вы успешно записаны');
        }
    }
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
