<?php
namespace App\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function dashboard()
    {
        $bookModel = new Book();
        $userModel = new User();
        $loanModel = new Loan();
        
        $totalBook = $bookModel->countAllResults();
        $totalUser = $userModel->where('role', 'user')->countAllResults();
        $totalBorrowed = $loanModel->where('status', 'borrowed')->countAllResults();
        $pendingReturns = $loanModel->where('status', 'borrowed')->where('return_requested', true)->countAllResults();
        $todayLoans = $loanModel->where('loan_date', date('Y-m-d'))->countAllResults();
        
        return view('admin/dashboard', [
            'totalBook' => $totalBook,
            'totalUser' => $totalUser,
            'totalBorrowed' => $totalBorrowed,
            'pendingReturns' => $pendingReturns,
            'todayLoans' => $todayLoans,
        ]);
    }
} 