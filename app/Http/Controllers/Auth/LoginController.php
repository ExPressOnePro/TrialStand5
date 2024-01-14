<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $loginType;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->loginType = $this->checkLoginInput();
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            $this->loginType => $request->login,
            'password' => $request->passw
        ];

        if (Auth::attempt($credentials, true)) {
            return redirect()->intended('home');
        }

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    protected function checkLoginInput()
    {
        $inputData = request()->get('login');

        return  filter_var($inputData, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
    }

    public function view() {
        return view('auth.login');
    }


    public function showLoginForm() {
        return view('auth.login');
    }



}
