<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'passw' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Пожалуйста, введите ваше имя',
            'first_name.string' => 'Имя должно быть строкой',

            'last_name.required' => 'Пожалуйста, введите вашу фамилию',
            'last_name.string' => 'Фамилия должна быть строкой',

            'email.required' => 'Пожалуйста, введите ваш адрес электронной почты',
            'email.string' => 'Адрес электронной почты должен быть строкой',
            'email.email' => 'Введите корректный адрес электронной почты',
            'email.max' => 'Адрес электронной почты не должен превышать 255 символов',
            'email.unique' => 'Пользователь с таким адресом электронной почты уже зарегистрирован',

            'login.required' => 'Пожалуйста, введите ваш логин или почту',
            'login.string' => 'Логин должен быть строкой',
            'login.max' => 'Логин не должен превышать 255 символов',
            'login.unique' => 'Пользователь с таким логином или почтой уже зарегистрирован',
            'login.exists' => 'Этой почты или логина не существует! Введите существующие данные',

            'passw.required' => 'Пожалуйста, введите пароль',
            'passw.string' => 'Пароль должен быть строкой',
            'passw.min' => 'Пароль должен содержать минимум 6 символов',
        ];
    }
}
