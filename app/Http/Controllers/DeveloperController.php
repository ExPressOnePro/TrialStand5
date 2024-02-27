<?php

namespace App\Http\Controllers;

use App\Models\Astart;
use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\CongregationsPermissions;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolesPermissions;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use App\Models\User;
use App\Models\UsersPermissions;
use App\Models\UsersRoles;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use OwenIt\Auditing\Facades\Auditor;

class DeveloperController extends Controller{

    public function maintenance()
    {
        return view('maintenance');
    }

    public function createBackup()
    {
        $backupJob = BackupJobFactory::createFromArray(config('laravel-backup.backup'));

        $backupJob->run();

        return response()->json(['message' => 'Backup created successfully']);
    }

    public function downloadBackup($fileName)
    {
        $backupPath = storage_path('app/' . config('laravel-backup.backup.destination.disks')[0] . '/' . $fileName);

        return response()->download($backupPath);
    }

    public function hub() {

        $roleDeveloper = Role::where('name', 'Developer')->first();
        $usersDeveloper = UsersRoles::where('role_id', $roleDeveloper->id)->get();
        $permissionModule = Permission::where('name', 'module.schedule')->first();

        $lastWeek = Carbon::now()->subWeek();
        $now = Carbon::now();

        $startOfCurrentWeek = $now->startOfWeek();
        $endOfCurrentWeek = $now->endOfWeek();

        $startOfLastWeek = $now->subWeek()->startOfWeek();
        $endOfLastWeek = $now->endOfWeek();

        $usersLastWeekCount = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $usersCurrentWeekCount = User::whereBetween('created_at', [$startOfCurrentWeek, $endOfCurrentWeek])->count();


        $userCountPercent = ($usersLastWeekCount / max(1, $usersCurrentWeekCount)) * 100;

        $usersCount = User::count();
        $lastWeekTimestamp = now()->subWeek()->timestamp;

        $usersActiveCount = User::where('info->last_login', '>=', $lastWeekTimestamp)->count();
        $usersActiveCount = User::where(DB::raw('info->>"$.last_login"'), '>=', $lastWeek)->count();

        $usersActiveCountPercent = ($usersActiveCount / max(1, $usersCount)) * 100;
        $usersRegistrationsCount = User::whereDate('created_at', '>=', Carbon::now()->subDays(2))->count();
        $usersRequestsCongregationsCount = CongregationRequests::count();
        $congregationCount = Congregation::where('id','!=', 1)->count();
        $standCount = Stand::count();

        $congregations = Congregation::get();

        $metrics = [
            [
                'title' => 'Пользователей',
                'route' => route('Developer.allUsers'),
                'count' => $usersCount,
                'percent' => $usersActiveCountPercent,
            ],

//            [
//                'title' => 'Активных за неделю',
//                'route' => route('developer.activeUsersDisplay'),
//                'count' => $usersActiveCount,
//                'percent' => $usersActiveCountPercent,
//            ],

            [
                'title' => 'Новые регистрации',
                'route' => route('developer.registeredUsersDisplay'),
                'count' => $usersRegistrationsCount,
                'percent' => null, // Здесь процент не указан
            ],
            [
                'title' => 'Новые запросы в собрания',
                'route' => route('developer.usersRequestsCongregation'),
                'count' => $usersRequestsCongregationsCount,
                'percent' => null, // Здесь процент не указан
            ],
            [
                'title' => 'Собрания',
                'route' => route('congregation.hub'),
                'count' => $congregationCount,
                'percent' => null, // Здесь процент не указан
            ],
            [
                'title' => 'Стенды',
                'route' => route('stand.hub'),
                'count' => $standCount,
                'percent' => null, // Здесь процент не указан
            ],
        ];


        $compact = compact(
            'usersCount',
            'metrics',
            'congregations',
        );

        return view ('BootstrapApp.Modules.developer.hub', $compact);

    }

    public function allUsers() {
        $users = User::get();

        return view('BootstrapApp.Modules.developer.displays.users')->with(['users' => $users]);

    }

    public function roles() {

        $roles = Role::get();
        $permissions = Permission::get();


        $compact = compact(
            'roles',
            'permissions',
        );

        return view ('Mobile.menu.modules.developer.displays.roles', $compact);
    }

    public function usersRequestsCongregation() {
        $congregationRequests = CongregationRequests::with('user', 'congregation')->get();

        $compact = compact(
            'congregationRequests',
        );
        $view = 'Mobile.menu.modules.developer.displays.usersRequestsCongregation';

        return view($view, $compact);
    }



    public function updatePermissionsForRole(Request $request, $roleId){

        // Получите роль
        $role = Role::findOrFail($roleId);

        // Обновите разрешения для роли
        $permissions = $request->input('permissions', []); // Получите выбранные разрешения из формы
        $role->permissions()->sync($permissions); // Синхронизируйте разрешения для роли

        return redirect()->back()->with('success', 'Разрешения успешно обновлены для роли ' . $role->name);
    }

    public function activeUsersDisplay() {
        $users = User::whereRaw('JSON_EXTRACT(info, "$.last_login") IS NOT NULL')
            ->orderByDesc('info->last_login')
            ->get();

        $compact = compact('users');
        return view('BootstrapApp.Modules.developer.displays.activeUsersDisplay', $compact);
    }

    public function registeredUsersDisplay() {
        $endDate = Carbon::now(); // Получаем текущую дату
        $startDate = $endDate->copy()->subDays(2); // Получаем дату, отстоящую от текущей на 2 дня

        $users = User::whereBetween('created_at', [$startDate, $endDate])->get();

        $compact = compact('users');
        return view('BootstrapApp.Modules.developer.displays.registeredUser', $compact);
    }

    public function rolesPermissionsPage() {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('Dev.RolesPermission')
            ->with(['roles' => $roles])
            ->with(['permissions' => $permissions]);
    }
    public function rolesPermissionsChoiceRole($id) {

        $role = Role::find($id);
        $permissions = Permission::get();

        $rolePermission = RolesPermissions::where('role_id', $id)->get();
        /*$permissions = RolesPermissions::where('role_id', $id)->get();*/


        return view('Dev.RolesPermissionChoiceRole')
            ->with(['rolePermission' => $rolePermission])
            ->with(['role' => $role])
            ->with(['permissions' => $permissions]);
    }

    /*Страница создания новой роли, нового права*/
    public function createNewRolePage() {
        /*$userAuditor = Auditor::audit(User::class);
        $userChanges = $userAuditor->count();*/

        $audits = StandPublishers::find(60231);

        return view('Dev.newRole')->with(['audits'=> $audits]);
    }
    public function createNewPermissionPage() {
        return view('Dev.newPermission');
    }

    /*POST отправка создания новой роли, права*/
    public function createNewRole(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->save();

        return redirect()->route('rolesPermissionsChoiceRole', $role->id);

    }
    public function createNewPermission(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $role = new Permission();
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->save();

        return redirect()->route('rolesPermissionsRole');

    }

    /*POST отправка изменения или удаления права для роли*/
    public function rolePermissionAllow(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $RolesPermissions = new RolesPermissions();
        $RolesPermissions->role_id = $id;
        $RolesPermissions->permission_id = $value;
        $RolesPermissions->save();

        return redirect()->route('rolesPermissionsChoiceRole', $id);
    }
    public function rolePermissionDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('roles_permissions')
            ->where('role_id', $id)
            ->where('permission_id', $value)
            ->delete();

        return redirect()->route('rolesPermissionsChoiceRole', $id);
    }

    /*POST отправка изменения или удаления Роли пользователя*/
    public function rolesPermissionsChange(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $user = new UsersRoles();
        $user->user_id = $id;
        $user->role_id = $value;
        $user->save();

        return redirect()->route('userCard', $id);
    }
    public function rolesPermissionsDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->route('userCard', $id);
    }

    public function DevTools(){

        return view('DeveloperTools.main');
    }

    public function devRoleUserUpdate() {
        $users = User::get();
        $rolePublisher = Role::where('name', 'Publisher')->first();
        $roleDeveloper = Role::where('name', 'Developer')->first();
        foreach ($users as $user) {
            UsersRoles::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => $rolePublisher->id
            ]);
        }
        $updatedMe = [
            'user_id' => 1,
            'role_id' => $roleDeveloper->id
        ];

        UsersRoles::where('user_id','1')->update($updatedMe);

        /*$user_id = 1; // ID пользователя, который нужно обновить
        $role_id = 2; // ID роли пользователя, которую нужно обновить

        $updatedData = [
            'column1' => 'новое значение 1',
            'column2' => 'новое значение 2',
            // другие столбцы и их новые значения
        ];

        UsersRoles::where('user_id', $user_id)
            ->where('role_id', $role_id)
            ->update($updatedData);*/


        $usersRoles = UsersRoles::where('role_id', $rolePublisher)->get();
        return redirect()->back();
    }

    public function generateCodes()
    {
        $users = User::all();

        foreach ($users as $user) {
            $uniqueCode = strtoupper(Str::random(6));
            $user->code = $uniqueCode;
            $user->save();
        }

        return 'Коды успешно сгенерированы!';
    }
}
