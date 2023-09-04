<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Astart;
use App\Models\PasswordReset;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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


        if ($user) {
            $token =  Str::random(60); // Генерируйте случайный токен
            PasswordReset::create([
                'email' => $user->login,
                'token' => $token,
            ]);

            // Генерируйте ссылку с токеном для сброса пароля
            $resetLink = route('password.reset', ['token' => $token, 'login' => $login]);

            // Передайте ссылку в представление Blade
            return view('Desktop.auth.passwords.resetLink', ['resetLink' => $resetLink]);

        } else {
            return redirect()->route('password.selectLogin')
                ->with('error', 'Такого Логина не существует');
        }
    }
    public function showReset($login) {

        return view('Desktop.auth.passwords.reset')->with(['login' => $login]);
    }

    public function updatePassword(Request $request, $login) {

        $password = $request->input('password');
        $user = User::where('login', $login)->first();

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


        return redirect()->route('auth.login')->with('success', 'Пароль успешно изменен, войдите в систему');
    }

}
