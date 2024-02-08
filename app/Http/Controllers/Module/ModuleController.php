<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\CongregationsPermissions;
use App\Models\MeetingScheduleTemplate;
use App\Models\Permission;
use App\Models\User;
use App\Models\UsersPermissions;
use App\Services\UserService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->UserService = $userService;
    }

    public function connectModuleToCongregation(Request $request){

        $permission_id = $request->input('permission_id');
        $congregation_id = $request->input('congregation_id');
        $permission = Permission::find($permission_id);

        $congregationPermission = new CongregationsPermissions();
        $congregationPermission->congregation_id = $congregation_id;
        $congregationPermission->permission_id = $permission_id;
        $congregationPermission->save();

        if($permission->name === 'module.schedule') {
            $this->attachModuleSchedule($congregation_id);
            $message = 'Модуль "расписание встреч" успешно подключен к вашему собранию';
        } elseif ($permission->name === 'module.stand') {
            $this->attachModuleStand($congregation_id);
            $message = 'Модуль "стенд" успешно подключен к вашему собранию';
        } elseif ($permission->name === 'module.contacts') {
            $this->attachModuleContacts($congregation_id);
            $message = 'Модуль "контакты" успешно подключен к вашему собранию';
        }

        return redirect()->back()->with('success', $message);
    }

    public function disconnectModuleToCongregation(Request $request){

        $permission_id = $request->input('permission_id');
        $congregation_id = $request->input('congregation_id');
        $permission = Permission::find($permission_id);
        $users = User::where('congregation_id', $congregation_id)->get();

        if($permission->name === 'module.schedule') {
            $this->detachModuleSchedule($congregation_id);
            $message = 'Модуль "расписание встреч" отключен';
        } elseif ($permission->name === 'module.stand') {
            $this->detachModuleStand($congregation_id);
            $message = 'Модуль "стенд" отключен';
        } elseif ($permission->name === 'module.contacts') {
            $this->detachModuleContacts($congregation_id);
            $message = 'Модуль "контакты" отключен';
        }


        CongregationsPermissions::where('congregation_id', $congregation_id)
            ->where('permission_id', $permission_id)
            ->delete();


        return redirect()->back()->with('success', $message);
    }

    public function attachModuleSchedule($congregation_id) {

        // добавить права для Admin собрания
        $users = User::where('congregation_id', $congregation_id)->get();
        foreach ($users as $user) {
            if($user->hasRole('Admin')){
                $user->givePermissionsTo(
                    'module.schedule',
                    'schedule.redaction',
                    'schedule.template'
                );
            } elseif ($user->hasRole('User')) {
                $user->givePermissionsTo(
                    'module.schedule'
                );
            }

        }

        $regular =  [
            "weekday" => [
                "responsible_users" =>  [],
                "songs" => ["1" => ["name" => "", "value" => ""], "2" =>  ["name" => "", "value" => ""], "3" =>  ["name" => "", "value" => ""]],
                "treasures" => [],
                "field_ministry" => [],
                "living" => []
            ],
            "weekend" => [
                "responsible_users" =>  [],
                "songs" => ["1" => ["name" => "", "value" => ""], "2" =>  ["name" => "", "value" => ""], "3" =>  ["name" => "", "value" => ""]],
                "public_speech" => [ "1" =>["name" => "", "value" => ""]],
                "watchtower" => [ "1" =>["name" => "Ведущий", "value" => ""]],
            ]
        ];
        $visit_district_elder =  [
            "weekday" => [
                "responsible_users" =>  [],
                "songs" => ["1" => ["name" => "", "value" => ""], "2" =>  ["name" => "", "value" => ""], "3" =>  ["name" => "", "value" => ""]],
                "treasures" => [],
                "field_ministry" => [],
                "public_speech_" => []
            ],
            "weekend" => [
                "responsible_users" =>  [],
                "songs" => ["1" => ["name" => "", "value" => ""], "2" =>  ["name" => "", "value" => ""], "3" =>  ["name" => "", "value" => ""]],
                "public_speech" => [ "1" =>["name" => "", "value" => ""]],
                "watchtower" => [ "1" =>["name" => "Ведущий", "value" => ""]],
            ]
        ];
        $regular_encode = json_encode($regular, true);
        $visit_district_elder_encode = json_encode($visit_district_elder, true);
        $MeetingScheduleTemplateExists = MeetingScheduleTemplate::query()->where('congregation_id', $congregation_id)->first();

        if (empty($MeetingScheduleTemplateExists)) {
            $MeetingScheduleTemplate = new MeetingScheduleTemplate();
            $MeetingScheduleTemplate->template_name = 'Обычная неделя';
            $MeetingScheduleTemplate->congregation_id = $congregation_id;
            $MeetingScheduleTemplate->template = $regular_encode;
            $MeetingScheduleTemplate->save();
        }

    }

    public function detachModuleSchedule($congregation_id) {

        $users = User::where('congregation_id', $congregation_id)->get();
        foreach ($users as $user) {
            if($user->hasRole('Admin')){
                $user->deletePermissions(
                    'module.schedule',
                    'schedule.redaction',
                    'schedule.template'
                );
            } elseif ($user->hasRole('User')){
                $user->deletePermissions(
                    'module.schedule'
                );
            }
        }
    }

    public function attachModuleStand($congregation_id) {

        // добавить права для Admin собрания
        $users = User::where('congregation_id', $congregation_id)->get();
        foreach ($users as $user) {
            if($user->hasRole('Admin')){
                $user->givePermissionsTo(
                    'module.stand',
                    'stand.settings',
                    'stand.history',
                    'stand.create',
                    'stand.make_entry',
                    'stand.delete_entry',
                    'stand.change_entry'
                );
            } elseif ($user->hasRole('User')) {
                $user->givePermissionsTo(
                    'module.stand',
                    'stand.make_entry',
                    'stand.delete_entry',
                    'stand.change_entry'
                );
            }
        }
    }

    public function detachModuleStand($congregation_id) {
        $users = User::where('congregation_id', $congregation_id)->get();
        foreach ($users as $user) {
            if($user->hasRole('Admin')){  // добавить права для Admin собрания
                $user->deletePermissions(
                    'module.stand',
                    'stand.settings',
                    'stand.history',
                    'stand.create',
                    'stand.make_entry',
                    'stand.delete_entry',
                    'stand.change_entry'
                );
            } elseif ($user->hasRole('User')){ // добавить права для User собрания
                $user->deletePermissions(
                    'module.stand',
                    'stand.make_entry',
                    'stand.delete_entry',
                    'stand.change_entry'
                );
            }
        }
    }

    public function attachModuleContacts($congregation_id) {

        // добавить права для Admin собрания
        $users = User::where('congregation_id', $congregation_id)->get();
        foreach ($users as $user) {
            if($user->hasRole('Admin')){
                $user->givePermissionsTo(
                    'module.contacts'
                );
            } elseif ($user->hasRole('User')) {
                $user->givePermissionsTo(
                    'module.contacts'
                );
            }
        }
    }

    public function detachModuleContacts($congregation_id) {
        $users = User::where('congregation_id', $congregation_id)->get();
        foreach ($users as $user) {
            if($user->hasRole('Admin')){  // добавить права для Admin собрания
                $user->deletePermissions(
                    'module.contacts'
                );
            } elseif ($user->hasRole('User')){ // добавить права для User собрания
                $user->deletePermissions(
                    'module.contacts'
                );
            }
        }
    }
}
