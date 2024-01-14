<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Models\ApiTokens;
use App\Models\Astart;
use App\Models\Audit;
use App\Models\CongregationsPermissions;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller{

    public function allUsersPage() {
        $user = User::find(Auth::id());

        if($user->hasRole('Developer')) {
            $users = User::get();
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
            return view('Mobile.menu.modules.users.users')
                ->with(['users' => $users]);
        }
    }

    public function getUserName(Request $request)
    {
        $userId = $request->input('user_id');

        // Retrieve the user based on user_id
        $user = User::find($userId);

        if ($user) {
            // If user is found, return the first name
            return response()->json(['data' => ['first_name' => $user->first_name]], 200);
        } else {
            // If user is not found, return an error response
            return response()->json(['error' => 'User not found.'], 404);
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
        $compact = compact(
            'user',
            'roles',
            'permissions',
            'groups',
            'congregation_id_to_name',
            'activeGroup',
            'audit',
            'standPublishers',
        );

        if ($detect->isMobile() && $user->hasRole('Developer')) {
            $compact['standPublishers'] = $standPublishers;
            return view('Mobile.menu.modules.users.card', $compact);
        } elseif ($detect->isMobile()) {
            return view('Mobile.menu.modules.users.card', $compact);
        } elseif ($user->hasRole('Developer')) {
            return view('Desktop.users.card', $compact);
        } else {
            return view('Desktop.users.card')->with($compact);
        }
    }

    public function displayResponsible() {
        $user = User::find(Auth::id());

        $users = User::with('usersroles.role', 'usersGroups.group')
            ->where('congregation_id', $user->congregation_id)
            ->get();

        $detect = new MobileDetect;

        return view('Mobile.menu.modules.users.displays.responsible')->with(['users' => $users]);

    }

    public function updateResponsibilities(Request $request)
    {
        $responsibilities = $request->input('responsibility'); // Получаем данные из формы

        if ($responsibilities === null) {
            // Если $responsibilities равно null, установите значение по умолчанию или выполняйте необходимую обработку.
            $responsibilities = [];
        }
        // Перебираем ответственность для каждого пользователя
        foreach ($responsibilities as $userId => $responsibility) {
            $user = User::find($userId);

            // Проверяем, что пользователь найден
            if ($user) {
                // Расшифровываем JSON-данные из столбца info
                $info = json_decode($user->info, true);

                // Присваиваем выбранное значение ответственности
                $info['responsible'] = $responsibility;

                // Обновляем JSON-столбец info в базе данных
                $user->info = json_encode($info);
                $user->save();
            }
        }

        // После обновления перенаправьте пользователя обратно или выполните другие действия
        return redirect()->back()->with('success', 'Ответственность успешно обновлена.');

    }


    public function permissionAllow(Request $request) {

        $roleGuest = Role::query()->where('name','=', 'Guest')->first('id');
        $user = new UsersPermissions();
        $user->user_id = $request->input('user_id');
        $user->permission_id = $request->input('permission_id');
        $user->save();

        return redirect()->back();
    }

    public function permissionDelete(Request $request,) {

        UsersPermissions::query()
            ->where('user_id', $request->input('user_id'))
            ->where('permission_id', $request->input('permission_id'))
            ->delete();
        return redirect()->back();
    }

    public function connectUser(CodeRequest $request) {
        $congregation_id = $request->input('congregationId');
        $user = User::where('code', $request->input('code'))->first();
        $congregationPermissions = CongregationsPermissions::query()->where('congregation_id', $congregation_id)->get();

        foreach ($congregationPermissions as $congregationPermission) {
            $userPermissions = new UsersPermissions();
            $userPermissions->user_id = $user->id;
            $userPermissions->permission_id = $congregationPermission->permission_id;
            $userPermissions->save();
        }

        $user->congregation_id = $congregation_id;
        $user->save();



        return redirect()->back()->with('success', 'Новый участник был добавлен в ваше собрание: ' . $user->first_name . ' ' . $user->last_name);
    }

    public function switchPermission(Request $request) {
//        $userId = $request->input('user_id');
//        $permissionId = $request->input('permission_id');
//        $isChecked = $request->input('is_checked');
//
//
//        $existingPermission = UsersPermissions::where('user_id', $userId)
//            ->where('permission_id', $permissionId)
//            ->first();
//
//        if ($isChecked && !$existingPermission) {
//            UsersPermissions::insert([
//                'user_id' => $userId,
//                'permission_id' => $permissionId,
//            ]);
//        } elseif (!$isChecked && $existingPermission) {
//            $existingPermission->delete();
//        }
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
        UsersRoles::query()
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

    public function updateGeneratePassword(Request $request) {

        $id = $request->input('userIdInput');
        $password = $request->input('code');

        $user = User::find($id);

        if ($user) {
            $user->update([
                'password' => Hash::make($password),
            ]);
            Astart::updateOrInsert(
                ['user_id' => $user->id],
                ['password' => $password]
            );
        } else {
            return response()->json(['error' => 'Ошибка восстановления пароля'], 404);
        }
        return redirect()->back()->with('success', 'Пароль успешно изменен');
    }
}
