<?php

namespace App\Validation;

class AuthValidation
{
    public static function getLoginRules(): array
    {
        return [
            'username' => 'required|min_length[3]|max_length[50]',
            'password' => 'required|min_length[6]'
        ];
    }

    public static function getLoginMessages(): array
    {
        return [
            'username' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username minimal 3 karakter',
                'max_length' => 'Username maksimal 50 karakter'
            ],
            'password' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 6 karakter'
            ]
        ];
    }
}