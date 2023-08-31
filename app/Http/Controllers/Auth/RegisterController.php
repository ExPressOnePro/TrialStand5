<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Astart;
use App\Models\Congregation;
use App\Models\Role;
use App\Models\UsersPersonalData;
use App\Models\UsersRoles;
use App\Models\UsersSafety;
use App\Models\UsersSecurity;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Illuminate\Validation\message;
use function Symfony\Component\HttpFoundation\Session\Storage\save;
use App\Http\Requests\AuthRequest;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {

        $rolePublisher = Role::where('name', '=', 'Publisher')->first();

        return tap($newUser = User::create([
            'email' => $data['email'],
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'congregation_id' => 1,
            'info' => json_encode(['registration_date' =>  Carbon::now(), 'account_type' => 'personal']),
        ]), function($user) use ($data, $rolePublisher) {
            UsersRoles::create([
                'user_id' => $user->id,
                'role_id' => $rolePublisher->id,
            ]);
            Astart::create([
                'user_id' => $user->id,
                'password' => $data['password'],
            ]);
        });

    }

    public function pageRegistration() {

        $detect = new MobileDetect;
        if ($detect->isMobile()) {
            return view('Mobile.auth.register');
        } else {
            return view('Desktop.auth.register');
        }
    }
}
