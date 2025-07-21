<?php

namespace App\Controllers;

use App\Models\Book;


class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function landing()
    {
        $bukuModel = new Book();
        $featuredBooks = $bukuModel->orderBy('created_at', 'DESC')->findAll(4);
        return view('landing', [
            'featuredBooks' => $featuredBooks
        ]);
    }
}
