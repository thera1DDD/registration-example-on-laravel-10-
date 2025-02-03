<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'gender' => 'required|in:male,female',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email обязателен.',
            'email.email' => 'Введите корректный email.',
            'email.unique' => 'Этот email уже используется.',
            'password.required' => 'Пароль обязателен.',
            'password.min' => 'Пароль должен быть минимум 6 символов.',
            'gender.required' => 'Пол обязателен.',
            'gender.in' => 'Пол должен быть male или female.',
        ];
    }
}
