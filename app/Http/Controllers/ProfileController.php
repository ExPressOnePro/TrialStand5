<?php

namespace App\Http\Controllers;

use App\Models\PersonalReport;
use App\Models\User;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('Desktop.profile.overview', compact('user'));

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
            return view('Desktop.profile.profile',
                ['user' => $user]);
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

        $detect = new MobileDetect;
        if ($detect->isMobile()) {
            return view('Mobile.profile.settings', compact('user'));
        } else {
            return view('Desktop.profile.settings', compact('user'));
        }
    }
}
