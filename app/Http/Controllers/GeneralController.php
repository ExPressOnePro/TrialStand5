<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalReportRequest;
use App\Models\PersonalReport;
use App\Models\User;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class  GeneralController extends Controller {


    public function ads(){

        return view('general.ads');
    }

    public function profile() {

        $id = Auth::id();
        $user = User::find($id);
        $personalReports = PersonalReport::where('user_id', $id)->where('year', Carbon::now()->year)->orderBy('month', 'desc')->get();

        $detect = new MobileDetect;
        if ($detect->isMobile()) {
            return view('Mobile.profile.profile',
                ['user' => $user],
                ['personalReports' => $personalReports]);
        } else {
            return view('Desktop.profile.profile',
                ['user' => $user],
                ['personalReports' => $personalReports]);
        }
    }
    public function profileBriefSave(Request $request, $id) {

        $user = User::find($id);
        $user->brief_information = $request->input('brief_information');
        $user->save();

        return redirect( route('profile'))->with('success', 'Изменения применены');
    }

    public function personalReport(Request $request) {
        $user = Auth::user();
        $year = $request->input('year');
        $month = $request->input('month');

        $existingReport = PersonalReport::where('user_id', $user->id)
            ->where('info->year', $year)
            ->where('info->month', $month)
            ->first();

        if ($existingReport) {
            return redirect()->back()->with('error', 'Отчет за выбранный месяц уже создан');
        }

        $hours = $request->input('hours') ?: 0;
        $publications = $request->input('publications') ?: 0;
        $videos = $request->input('videos') ?: 0;
        $return_visits = $request->input('return_visits') ?: 0;
        $bible_studies = $request->input('bible_studies') ?: 0;

        $reportData = json_encode([
            'year' => $year,
            'month' => $month,
            'hours' => $hours,
            'publications' => $publications,
            'videos' => $videos,
            'return_visits' => $return_visits,
            'bible_studies' => $bible_studies,
        ]);

        $user->personalReports()->create([
            'user_id' => $user->id,
            'info' => $reportData,
        ]);

        return redirect()->back()->with('success', 'Отчет отправлен');
    }

    public function profileEdit($id) {
        $user = User::find($id);
        return view('NavigationBar.profile.edit', ['user' => $user]);
    }

    public function profileEditSave(Request $request, $id) {

        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->gender = $request->input('gender');
        $user->birthday = $request->input('birthday');
        $user->login = $request->input('login');
        $user->save();


        return redirect( route('profile'))->with('success', 'Изменения применены');
    }

    public function profileSecurity($id) {
        $user = User::find($id);
        return view('NavigationBar.profile.security', ['user' => $user]);
    }

    public function profileSecuritySave(Request $request, $id) {

        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->gender = $request->input('gender');
        $user->birthday = $request->input('birthday');
        $user->login = $request->input('login');
        $user->save();


        return redirect( route('profile'))->with('success', 'Изменения применены');
    }
    public function profileContacts($id) {
        $user = User::find($id);
        return view('NavigationBar.profile.contacts', ['user' => $user]);
    }

    public function profileContactsSave(Request $request, $id) {

        $user = User::find($id);
        $user->mobile_phone = $request->input('mobile_phone');
        $user->additional_phone = $request->input('additional_phone');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->languages = $request->input('languages');
        $user->save();


        return redirect( route('profile'))->with('success', 'Изменения применены');
    }

}
