<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CodeRequest extends FormRequest
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
            'code' => ['required', 'min:6', 'max:6', 'exists:users,code'],
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Дополнительная проверка: congregation_id должен быть равен 1
            $codeExists = User::query()
                ->where('code', $this->input('code'))
                ->where('congregation_id', 1)
                ->exists();

            if (!$codeExists) {
                $validator->errors()->add('code', 'Пользователь с указанным кодом, принадлежит к собранию');
            }
        });
    }

    public function messages()
    {
        return [
            'code.required' => 'Пожалуйста, введите код пользователя',
            'code.exists' => 'Введенного кода не существует',
            'code.min' => 'Код меньше 6 символов',
            'code.max' => 'Код больше 6 символов',
            'code.custom' => 'Пользователь с указанным кодом не существует или не принадлежит к нужному congregation_id.',
        ];
    }
}
