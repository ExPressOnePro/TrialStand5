<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function presentMeetingSchedules() {
        return view('BootstrapApp.presentations.meeting_shedules');
    }
}
