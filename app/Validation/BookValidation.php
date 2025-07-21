<?php

namespace App\Validation;

class BookValidation
{
    public static function getCreateRules(): array
    {
        return [
            'title' => 'required|min_length[1]|max_length[255]',
            'author' => 'required|min_length[1]|max_length[255]',
            'year' => 'permit_empty|numeric|min_length[4]|max_length[4]',
            'description' => 'permit_empty|max_length[1000]',
            'cover' => 'permit_empty|mime_in[cover,image/jpg,image/jpeg,image/webp,image/svg+xml,image/png]|max_size[cover,2048]'
        ];
    }

    public static function getUpdateRules(): array
    {
        return self::getCreateRules();
    }

    public static function getMessages(): array
    {
        return [
            'title' => [
                'required' => 'Judul harus diisi',
                'min_length' => 'Judul minimal 1 karakter',
                'max_length' => 'Judul maksimal 255 karakter'
            ],
            'author' => [
                'required' => 'Penulis harus diisi',
                'min_length' => 'Nama penulis minimal 1 karakter',
                'max_length' => 'Nama penulis maksimal 255 karakter'
            ],
            'year' => [
                'numeric' => 'Tahun harus berupa angka',
                'min_length' => 'Tahun harus 4 digit',
                'max_length' => 'Tahun harus 4 digit'
            ],
            'description' => [
                'max_length' => 'Deskripsi maksimal 1000 karakter'
            ],
            'cover' => [
                'mime_in' => 'Tipe file cover tidak valid. Hanya menerima JPG, JPEG, WEBP, SVG, atau PNG.',
                'max_size' => 'Ukuran file cover terlalu besar. Maksimal 2MB.'
            ]
        ];
    }
}