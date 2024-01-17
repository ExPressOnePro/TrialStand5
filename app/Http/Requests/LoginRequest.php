<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string',
                function ($attribute, $value, $fail) {
                    if (!User::where('login', $value)->orWhere('email', $value)->exists()) {
                        $fail('Этой почты или логина не существует! Введите существующие данные');
                    }
                }
            ],
            'passw' => ['required', 'string', 'min:6',
                function ($attribute, $value, $fail) {
                    $user = User::where('login', request('login'))->orWhere('email', request('login'))->first();

                    if (!$user || !Hash::check($value, $user->password)) {
                        $fail('Пароль неверен');
                    }
                }
                ],
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Пожалуйста, введите логин или почту',
            'login.exists' => 'Этой почты или логина не существует! Введите существующие данные',
            'passw.required' => 'Пожалуйста, введите пароль',
            'passw.min' => 'Пароль должен содержать минимум 6 символов',
        ];
    }
}
