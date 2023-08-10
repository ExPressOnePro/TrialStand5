<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showSelectLogin() {

        return view('Desktop.auth.passwords.selectLogin');
    }
    public function SelectLogin(Request $request) {

        $login = $request->input('value');
        $user = User::where('login', $login)->first();


        if(is_null($user)){
            return redirect()->route('password.selectLogin')
                ->with('error', 'Такого Логина не существует');
        } else {
            return redirect()->route('password.forgot', ['login' => $user->login]);
        }
    }
    public function showReset($login) {

        return view('Desktop.auth.passwords.reset')->with(['login' => $login]);
    }

    public function updatePassword(Request $request, $login) {
        $password = $request->input('password');

        $user = User::where('login', $login)
            ->update([
            'password' => Hash::make($password),
        ]);

        return redirect()->route('auth.login')->with('success', 'Пароль успешно изменен, войдите в систему');
    }

}
