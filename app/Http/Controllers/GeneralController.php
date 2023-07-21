<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalReportRequest;
use App\Models\PersonalReport;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {


    public function ads(){

        return view('general.ads');
    }

    public function profile() {

        $id = Auth::id();
        $user = User::find($id);
        $personalReports = PersonalReport::where('user_id', $id)->orderBy('month', 'desc')->get();

        return view('general.profile',
            ['user' => $user],
            ['personalReports' => $personalReports]
        );
    }
    public function personalReport(PersonalReportRequest $request) {

        $personalReportUserID = PersonalReport::where('user_id', Auth::id())->get();

        foreach ($personalReportUserID as $personalReportUser) {

            if (is_null($personalReportUser)) {
                $eee = PersonalReport::firstOrCreate([
                    'user_id' => Auth()->id(),
                    'year' => Carbon::now()->year,
                    'month' => $request->input('month'),
                    'hours' => $request->input('hours'),
                    'publications' => $request->input('publications'),
                    'videos' => $request->input('videos'),
                    'return_visits' => $request->input('return_visits'),
                    'bible_studies' => $request->input('bible_studies'),
                ]);
                return redirect()->back()->with('success', 'Отчет отправлен');
            }
            else {
                if($personalReportUser->month != $request->input('month')) {
                    $sss = PersonalReport::firstOrCreate([
                        'user_id' => Auth()->id(),
                        'year' => Carbon::now()->year,
                        'month' => $request->input('month'),
                        'hours' => $request->input('hours'),
                        'publications' => $request->input('publications'),
                        'videos' => $request->input('videos'),
                        'return_visits' => $request->input('return_visits'),
                        'bible_studies' => $request->input('bible_studies'),
                    ]);
                }
                else {
                    return redirect()->back()->with('error', 'отчет за выбранный месяц уже отправлен');
                }
            }
        }




        return redirect()->back();
    }

}
