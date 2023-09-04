<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Astart;
use App\Models\PersonalReport;
use App\Models\User;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function overview() {

        $id = Auth::id();
        $user = User::find($id);
//        $personalReports = PersonalReport::where('user_id', $id)->where('year', Carbon::now()
//            ->year)->orderBy('month', 'desc')->get();

        $detect = new MobileDetect;
        if ($detect->isMobile()) {
            return view('Mobile.profile.overview', compact('user'));
        } else {
            return view('Mobile.profile.overview', compact('user'));
            //return view('Desktop.profile.overview', compact('user'));

        }
    }



    public function info() {

        $array = [
            'city' => 'Бельцы',
            'mobile_phone' => '068484866'
        ];

        $u = User::find(1);
        $u->info = $array;
        $u->save();
    }

    public function profile() {

        $id = Auth::id();
        $user = User::with('apiTokens')->find($id);
//        $personalReports = PersonalReport::where('user_id', $id)->where('year', Carbon::now()->year)->orderBy('month', 'desc')->get();


        $detect = new MobileDetect;
        if ($detect->isMobile()) {
            return view('Mobile.profile.profile',
                ['user' => $user]);
//                ['personalReports' => $personalReports]);
        } else {
            return view('Mobile.profile.profile',
                ['user' => $user]);
//            return view('Desktop.profile.profile',
//                ['user' => $user]);
//                ['personalReports' => $personalReports]);
        }
    }

    public function reports() {
        $user = Auth::user();

        // Проверяем, что запись была найдена
        $reportsData = PersonalReport::where('user_id', $user->id)->get();
        $reportInfo = [];
        $years = [];

        if ($reportsData) {
            foreach ($reportsData as $reportData) {
                $reportInfo[] = json_decode($reportData->info, true);
                foreach ($reportInfo as $item) {
                    $years[] = $item['year'];
                }
            }

            $uniqueYears = array_unique($years); // Получаем уникальные годы

            return view('Mobile.profile.reports', ['reportData' => $reportInfo, 'years' => $uniqueYears]);
        } else {
            return redirect()->route('home')->with('error', 'Отчет не найден');
        }

//        $detect = new MobileDetect;
//        if ($detect->isMobile()) {
//            return view('Mobile.profile.reports', compact('user', 'years', 'selectedYear', 'selectedReports'));
//        } else {
//            return view('Desktop.profile.reports', compact('user'));
//
//        }
    }

    public function settings() {

        $id = Auth::id();
        $user = User::find($id);


        $userInfo = json_decode($user->info, true);

// Проверка и присвоение значений по умолчанию
        $gender = isset($userInfo['gender']) ? $userInfo['gender'] : '';
        $country = isset($userInfo['country']) ? $userInfo['country'] : '';
        $city = isset($userInfo['city']) ? $userInfo['city'] : '';
        $mobile_phone = isset($userInfo['mobile_phone']) ? $userInfo['mobile_phone'] : '';
        $additional_phone = isset($userInfo['additional_phone']) ? $userInfo['additional_phone'] : '';


        $detect = new MobileDetect;
        if ($detect->isMobile()) {
            return view('Mobile.profile.settings', compact('user', 'gender',
            'country',
            'city',
            'mobile_phone',
            'additional_phone',
            ));
        } else {
            return view('Mobile.profile.settings', compact('user', 'gender',
                'country',
                'city',
                'mobile_phone',
                'additional_phone',
            ));
//            return view('Desktop.profile.settings', compact('user'));
        }
    }

    public function basicInfoSave(Request $request) {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $gender = $request->input('inputGroupMergeGenderSelect');

        $id = Auth::id();
        $user = User::find($id);
        $userInfo = json_decode($user->info, true);

// Обновляем информацию в JSON-массиве
        $userInfo['gender'] = $gender;

// Обновляем данные в одноименных столбцах
        $user->first_name = $first_name;
        $user->last_name = $last_name;

// Обновляем JSON-поле в базе данных
        $user->info = json_encode($userInfo);

// Сохраняем изменения
        $user->save();


        $array = [
            'mobile_phone' => '068484866',
            'addition_phone' => '',
            'gender' => '',
            'country' => 'Moldova',
            'city' => 'Balti',
            'address' => 'Бельцы',
            'birthday' => '',
            'christening_day' => '',
        ];


        $contactsArray = [
            'country' => 'Moldova',
            'city' => 'Balti',
            'mobile_phone' => '068484866',
            'addition_phone' => '',
        ];

        return redirect()->back();

//        $detect = new MobileDetect;
//        if ($detect->isMobile()) {
//            return view('Mobile.profile.settings', compact('user'));
//        } else {
//            return view('Desktop.profile.settings', compact('user'));
//        }
    }
    public function contactsInfoSave(Request $request) {
        $country = $request->input('inputMergeCountrySelect');
        $city = $request->input('inputMergeCitySelect');
        $mobile_phone = $request->input('mobile_phone');
        $additional_phone = $request->input('additional_phone');

        $id = Auth::id();
        $user = User::find($id);
        $userInfo = json_decode($user->info, true);

// Добавление или обновление данных в JSON-массиве
        $userInfo['country'] = $country;
        $userInfo['city'] = $city;
        $userInfo['mobile_phone'] = $mobile_phone;
        $userInfo['additional_phone'] = $additional_phone;

// Обновление JSON-поля в базе данных
        $user->info = json_encode($userInfo);

// Сохранение изменений
        $user->save();


        $array = [
            'mobile_phone' => '068484866',
            'addition_phone' => '',
            'gender' => '',
            'country' => 'Moldova',
            'city' => 'Balti',
            'address' => 'Бельцы',
            'birthday' => '',
            'christening_day' => '',
        ];


        $contactsArray = [
            'country' => 'Moldova',
            'city' => 'Balti',
            'mobile_phone' => '068484866',
            'addition_phone' => '',
        ];

        return redirect()->back();

//        $detect = new MobileDetect;
//        if ($detect->isMobile()) {
//            return view('Mobile.profile.settings', compact('user'));
//        } else {
//            return view('Desktop.profile.settings', compact('user'));
//        }
    }

    public function changePassword(Request $request) {
        $user = auth()->user(); // Получение текущего пользователя
        $userAstart = Astart::where('user_id', $user->id)->first(); // Получение текущего пользователя
        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('newPassword');

        if (Hash::check($currentPassword, $user->password)) {
            // Текущий пароль совпадает, обновляем хеш нового пароля
            $user->password = Hash::make($newPassword);
            $user->password = Hash::make($newPassword);
            if (!$userAstart) {
                // Если запись Astart не найдена, создаем новую
                $userAstart = new Astart();
                $userAstart->user_id = $user->id;
            }

            $userAstart->password = $newPassword;
            $userAstart->save();
            $user->save();

            return redirect()->back()->with('success', 'Пароль успешно изменен.');
        } else {
            return redirect()->back()->with('error', 'Текущий пароль введен неверно.');
        }
    }
}
