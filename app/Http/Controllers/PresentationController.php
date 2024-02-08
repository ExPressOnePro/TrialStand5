<?php

namespace App\Http\Controllers;

use App\Models\CongregationsPermissions;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentationController extends Controller
{
    public function presentationMeetingSchedules() {
        $permissionMeetingSchedules = Permission::where('name', '=', 'module.schedule')->first();
        $permission = CongregationsPermissions::where('congregation_id', '=', Auth::user()->congregation_id)->where('permission_id', $permissionMeetingSchedules->id)->count();

        $compact = compact('permission');
        return view('BootstrapApp.presentations.meeting_shedules', $compact);
    }
    public function documentationMeetingSchedules() {
        return view('BootstrapApp.presentations.documentation');
    }


}
