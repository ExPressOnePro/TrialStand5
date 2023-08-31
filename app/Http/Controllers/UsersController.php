<?php

namespace App\Http\Controllers;

use App\Models\ApiTokens;
use App\Models\Audit;
use App\Models\Group;
use App\Models\Permission;
use App\Models\StandPublishers;
use App\Models\User;
use App\Models\Role;
use App\Models\UsersGroups;
use App\Models\UsersPermissions;
use App\Models\UsersRoles;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller{

    public function allUsersPage() {
        $user = User::find(Auth::id());

        if($user->hasRole('Developer')) {
            $users = User::with('usersroles.role', 'usersGroups.group')->get();
        } else {
                $users = User::with('usersroles.role', 'usersGroups.group')
                    ->where('congregation_id', $user->congregation_id)
                    ->get();
        }


        $detect = new MobileDetect;
        if ($detect->isMobile()) {
            return view('Mobile.menu.modules.users.users')
                ->with(['users' => $users]);
        } else {
            return view('Desktop.users.users')
                ->with(['users' => $users]);

        }
    }

    public function userCard(StandPublishers $StandPublishers, $id) {

        $user = User::find(Auth::id());
        $groups = Group::get();
        if($user->hasRole('Developer')) {
            $roles = Role::get();
            $permissions = Permission::get();
        } else{
            $permissions = Permission::where('name', 'LIKE', 'Stand%')->get();
            $roles = Role::get();
        }

        $user = User::with('usersroles.role', 'usersGroups.group')->find($id);

        $auditHistory = $user->audit_history;

        $standPublishers = $StandPublishers->audits()->get();

        $congregation_id_to_name = DB::table('users')
            ->join('congregations', 'users.id', '=', 'congregations.id')
            ->where('congregations.id', $id)
            ->get();

        $audit = Audit::with('user')
            ->where('user_id', $id)
            ->where('auditable_type', '=','App\Models\StandPublishers')
            ->get();

        $activeGroup = UsersGroups::where('user_id', $id)->pluck('group_id')->first(); // Получите активную группу пользователя с user_id 1


        $detect = new MobileDetect;
        $viewData = [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'groups' => $groups,
            'congregation_id_to_name' => $congregation_id_to_name,
            'activeGroup' => $activeGroup,
            'audit' => $audit,
            'standPublishers' => null
        ];

        if ($detect->isMobile() && $user->hasRole('Developer')) {
            $viewData['standPublishers'] = $standPublishers;
            return view('Mobile.menu.modules.users.card', $viewData);
        } elseif ($detect->isMobile()) {
            return view('Mobile.menu.modules.users.card', $viewData);
        } elseif ($user->hasRole('Developer')) {
            return view('Desktop.users.card', $viewData);
        } else {
            return view('Desktop.users.card')->with($viewData);
        }

    }
    public function permissionAllow(Request $request, $id) {
        $value = $request->input('allow_permission_id');
        $user = new UsersPermissions();
        $user->user_id = $id;
        $user->permission_id = $value;
        $user->save();

        return redirect()->back();
    }
    public function permissionDelete(Request $request, $id) {
        $value = $request->input('delete_permission_id');
        DB::table('users_permissions')
            ->where('user_id', $id)
            ->where('permission_id', $value)
            ->delete();

        return redirect()->back();
    }
    public function roleAllow(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $user = new UsersRoles();
        $user->user_id = $id;
        $user->role_id = $value;
        $user->save();

        return redirect()->back();
    }
    public function roleDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        UsersRoles::where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->back();
    }

    public function personalMonthlyReport(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->route('userCard', $id);
    }

    public function changeGroup(Request $request, $id) {
        $group_id = $request->input('group_id');
        $updatedMe = [
            'user_id' => $id,
            'group_id' => $group_id
        ];

        $stringGroup = UsersGroups::where('user_id', $id)->first();

        if($stringGroup) {
            UsersGroups::where('user_id', $id)->update($updatedMe);
        } else {
            UsersGroups::firstOrCreate([
                'user_id' => $id,
                'group_id' =>$group_id
            ]);
        }

        return redirect()->back();
    }

    public function generateToken($id) {
        $apiToken = new ApiTokens();
        $apiToken->user_id = $id;
        $apiToken->token = Str::random(32);
        $apiToken->save();

        return $apiToken;
    }

}
