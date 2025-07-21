<?php
namespace App\Models;

use CodeIgniter\Model;

class Loan extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'book_id', 'loan_date', 'return_date', 'status', 'return_requested', 'return_requested_at'];
    protected $useTimestamps = true;
    protected $returnType = 'array';
    
    // Get loans with book and user information
    public function getLoansWithDetails($userId = null)
    {
        $builder = $this->db->table('loans l')
            ->select('l.*, b.title as book_title, b.author as book_author, u.username')
            ->join('books b', 'l.book_id = b.id', 'left')
            ->join('users u', 'l.user_id = u.id', 'left')
            ->orderBy('l.created_at', 'DESC');
        
        if ($userId) {
            $builder->where('l.user_id', $userId);
        }
        
        return $builder->get()->getResultArray();
    }
    
    // Get active loans for a user
    public function getActiveLoansByUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('status', 'borrowed')
                    ->findAll();
    }
    
    // Check if book is available for loan
    public function isBookAvailable($bookId)
    {
        $activeLoan = $this->where('book_id', $bookId)
                           ->where('status', 'borrowed')
                           ->first();
        
        return $activeLoan === null;
    }
    
    // Get overdue loans
    public function getOverdueLoans()
    {
        return $this->where('status', 'borrowed')
                    ->where('loan_date <', date('Y-m-d', strtotime('-14 days')))
                    ->findAll();
    }
    
    // Get loans with pending return requests
    public function getPendingReturnRequests()
    {
        return $this->db->table('loans l')
            ->select('l.*, b.title as book_title, b.author as book_author, u.username')
            ->join('books b', 'l.book_id = b.id', 'left')
            ->join('users u', 'l.user_id = u.id', 'left')
            ->where('l.status', 'borrowed')
            ->where('l.return_requested', true)
            ->orderBy('l.return_requested_at', 'ASC')
            ->get()->getResultArray();
    }
    
    // Get loans with return requests by user
    public function getReturnRequestsByUser($userId)
    {
        return $this->db->table('loans l')
            ->select('l.*, b.title as book_title, b.author as book_author')
            ->join('books b', 'l.book_id = b.id', 'left')
            ->where('l.user_id', $userId)
            ->where('l.status', 'borrowed')
            ->where('l.return_requested', true)
            ->orderBy('l.return_requested_at', 'DESC')
            ->get()->getResultArray();
    }
} 