<?php

namespace App\Validation;

class LoanValidation
{
    public static function getBorrowRules(): array
    {
        return [
            'book_id' => 'required|numeric|greater_than[0]',
            'user_id' => 'required|numeric|greater_than[0]'
        ];
    }

    public static function getBorrowMessages(): array
    {
        return [
            'book_id' => [
                'required' => 'Book ID harus diisi',
                'numeric' => 'Book ID harus berupa angka',
                'greater_than' => 'Book ID tidak valid'
            ],
            'user_id' => [
                'required' => 'User ID harus diisi',
                'numeric' => 'User ID harus berupa angka',
                'greater_than' => 'User ID tidak valid'
            ]
        ];
    }
}