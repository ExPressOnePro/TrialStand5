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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Facades\Auditor;

class DeveloperController extends Controller{

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


        if ($usersLastWeekCount > 0 && $usersCurrentWeekCount > 0) {
            $userCountPercent = ($usersLastWeekCount / $usersCurrentWeekCount) * 100;
        } else {
            $userCountPercent = 0; // Защита от деления на ноль
        }

        $usersCount = User::count();

        $usersActiveCount = User::where(DB::raw('info->>"$.last_login"'), '>=', $lastWeek)->count();
        $usersActiveCountPercent = ($usersActiveCount / $usersCount) * 100;
        $usersRegistrationsCount = User::whereDate('created_at', '>=', Carbon::now()->subDays(2))->count();
        $usersRequestsCongregationsCount = CongregationRequests::count();
        $congregationCount = Congregation::where('id','!=', 1)->count();
        $standCount = Stand::count();

        $congregations = Congregation::get();

        $metrics = [
            [
                'title' => 'Пользователей',
                'route' => route('users'),
                'count' => $usersCount,
                'percent' => $userCountPercent,
            ],

            [
                'title' => 'Активных за неделю',
                'route' => route('developer.activeUsersDisplay'),
                'count' => $usersActiveCount,
                'percent' => $usersActiveCountPercent,
            ],

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

        return view ('Mobile.menu.modules.developer.hub', $compact);

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
        return view('Mobile.menu.modules.developer.displays.activeUsersDisplay', $compact);
    }

    public function registeredUsersDisplay() {
        $endDate = Carbon::now(); // Получаем текущую дату
        $startDate = $endDate->copy()->subDays(2); // Получаем дату, отстоящую от текущей на 2 дня

        $users = User::whereBetween('created_at', [$startDate, $endDate])->get();

        $compact = compact('users');
        return view('Mobile.menu.modules.developer.displays.registeredUser', $compact);
    }



    public function testViewButtons() {

        $roleDeveloper = Role::where('name', 'Developer')->first();
        $usersDeveloper = UsersRoles::where('role_id', $roleDeveloper->id)->get();


        $array = [
            'Cretugena1969@gmail.com' => 'gena1969',
            '1scoscodan@gmail.com' => '4685583275',
            'eddimir@gmail.com' => 'A60651668',
            'popovici1233@gmail.com' => 'popovici1233',
            'tatiana.suiu@gmail.com' => 'SuperPassword123',
            'BabanAliona' => '7834793757',
            'BabichLilia' => '1545324046',
            'BalabanAnna' => '2615807742',
            'BalabanEfim' => '2732849306',
            'BalabanEvgenii' => '069102199',
            'BalabanNatalia' => '7798182396',
            'BalabanSvetlana' => '5674819727',
            'BalabanVladimir' => '2579718787',
            'JarkovaInna' => '9836781067',
            'BurlacuRaisa' => '9616022948',
            'viktor.mishukov@mail.ru' => 'sanson456',
            'Viktoria' => '1620602402',
            'VoitikValentina' => '5057176759',
            'GaletskiiInna' => '4704253264',
            'GaletskiiDmitrii' => '30720919',
            'GolovkoNikita' => '7685304705',
            'GolovkoOlga' => '1227470989',
            'DeleuValentina' => '1033403404',
            'DolgincevaO' => '9810819955',
            'JarkovaKarina' => '3235647564',
            'JosanLudmila' => '5211429353',
            'ZaitsevSergei' => '148705229',
            'ZaitsevaNatalia' => '6025607188',
            'KazakSergei' => '3310365155',
            'KarasevaNadezhda' => '5532948394',
            'KoshelevaIrina' => '5787241726',
            'KoshkodanIana' => '3956258518',
            'KoshkodanSergei' => '918632814',
            'KretsuGennadii' => '6849378970',
            'KulinskiiAnna' => '9855756434',
            'KulinskiiAlexandr' => '5293512935',
            'LupanovaRaisa' => '4640505498',
            'LupanovaSvetlana' => '6476140857',
            'MatiescuRuslana' => '7223265720',
            'MatkovskaiaAnna' => '3613338158',
            'deeanlife@gmail.com' => 's00705119',
            'MironEduard' => '8333814408',
            'MironEmil' => '4066143982',
            'MironIvan' => '4574994738',
            'MironMaria' => '2025588819',
            'MironVioletta' => '6268258813',
            'MironovaDina' => '3963756881',
            'dnepr-dnestr90@mail.ru' => 'sanson456sanson',
            'NebesniiEkaterina' => '3264600605',
            'NebesniiStanislav' => '3381499139',
            'OberstEvdokia' => '4882471667',
            'PasecinicNina' => '848325905',
            'PatrascuSvetlana' => '436302186',
            'PogonetOlga' => '5421147073',
            'PogonetRodeon' => '3052635655',
            'PopoviciAliona' => '8953274337',
            'PopoviciVictor' => '4163975641',
            'PustiiMaria' => '3280230034',
            'RotariNatalia' => '760532205',
            'RusnacMamlikat' => '8287580992',
            'RusnakGalina' => '4908037149',
            'RusnakValerii' => '6710810419',
            'ValeriiRusnaс' => '8648250208',
            'SajinEvgenii' => '6849871813',
            'SajinOlesia' => '2081512181',
            'SajinTatiana' => '5460404569',
            'SkobelkinaValentina' => '5450263207',
            'SmirnovEvgenii' => 'petro0202',
            'SmirnovaElena' => '431904836',
            'StingachZinaida' => '7146248686',
            'TkaciIulia' => '9115055722',
            'UrsatiiLudmila' => '9806345224',
            'UrsatiiPavel' => '4428030913',
            'HodjaevaTamara' => '5038245716',
            'SaragovIvan' => '7686636835',
            'SaragovaAlina' => '76729292',
            'SAlex' => '8049830835',
            'Taniaspac1987@gmail.com' => 'Sp69630804',
            'SergiuSuiu' => '24372041',
            'SuiuTatiana' => '8627591465',
            'IakushevaOlga' => '9312075579',
        ];


        foreach ($array as $login => $password) {
            // Ищем пользователя по логину
            $user = User::where('login', $login)->first();

            if ($user) {
                // Обновляем поле password
                $user->password = Hash::make($password);
                $user->save();
                Astart::updateOrInsert(
                    ['user_id' => $user->id],
                    ['password' => $password]
                );
            }
        }
    }

    public function test1button() {

        $roleDeveloper = Role::where('name', 'Developer')->first();
        $permissionModule = Permission::where('name', 'module.stand')->first();
        $congregation = '2';
        $usersCongregation = User::where('congregation_id', $congregation)->get();

        $usersPermissionModule = UsersPermissions::
        whereIn('user_id', User::where('congregation_id', '2')->pluck('id'))
            ->where('permission_id', $permissionModule->id)->get();


        foreach($usersCongregation as $userCongregation) {
            $RolesPermissions = new UsersPermissions();
            $RolesPermissions->user_id = $userCongregation->id;
            $RolesPermissions->permission_id = $permissionModule->id;
            $RolesPermissions->save();
        }

        $congregationPermission = new CongregationsPermissions();
        $congregationPermission->congregation_id = $congregation;
        $congregationPermission->permission_id = $permissionModule->id;
        $congregationPermission->save();

        return redirect()->route('testViewButtons');

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
}
