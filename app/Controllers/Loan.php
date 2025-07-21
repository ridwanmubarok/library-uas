<?php
namespace App\Controllers;

use App\Models\Loan as LoanModel;
use App\Models\Book;
use App\Models\User;
use App\Validation\LoanValidation;

class Loan extends BaseController
{
    protected $loanModel;
    protected $bookModel;
    protected $userModel;
    
    public function __construct()
    {
        $this->loanModel = new LoanModel();
        $this->bookModel = new Book();
        $this->userModel = new User();
    }
    
    public function index()
    {
        $userId = session('role') === 'admin' ? null : session('user_id');
        $loans = $this->loanModel->getLoansWithDetails($userId);
        
        $data = [
            'loans' => $loans,
            'title' => session('role') === 'admin' ? 'Kelola Peminjaman' : 'Riwayat Peminjaman'
        ];
        
        return view('loan/index', $data);
    }
    
    public function borrow($bookId)
    {
        if (!session('user_id')) {
            return redirect()->to('/login')->with('toast', 'Silakan login terlebih dahulu');
        }

        if (session('role') !== 'user') {
            return redirect()->to('/buku')->with('toast', 'Hanya user yang dapat meminjam buku');
        }
        
        $book = $this->bookModel->find($bookId);
        if (!$book) {
            return redirect()->to('/buku')->with('toast', 'Buku tidak ditemukan');
        }
        
        if (!$this->loanModel->isBookAvailable($bookId)) {
            return redirect()->to('/buku')->with('toast', 'Buku sedang dipinjam');
        }
        
        $activeLoans = $this->loanModel->getActiveLoansByUser(session('user_id'));
        if (count($activeLoans) >= 3) {
            return redirect()->to('/buku')->with('toast', 'Anda sudah meminjam maksimal 3 buku');
        }
        
        $data = [
            'book' => $book,
            'title' => 'Pinjam Buku'
        ];
        
        if (session('validation')) {
            $data['validation'] = session('validation');
        }
        
        return view('loan/borrow', $data);
    }
    
    public function store()
    {
        $bookId = $this->request->getPost('book_id');
        $userId = session('user_id');
        $validation = \Config\Services::validation();
        $validation->setRules(LoanValidation::getBorrowRules(), LoanValidation::getBorrowMessages());
        
        $data = ['book_id' => $bookId, 'user_id' => $userId];
        
        if (!$validation->run($data)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        
        $canBorrowResult = $this->canBorrowBook($bookId, $userId);
        if (!$canBorrowResult['success']) {
            return redirect()->back()->with('toast', $canBorrowResult['message']);
        }
        
        $loanData = [
            'user_id' => $userId,
            'book_id' => $bookId,
            'loan_date' => date('Y-m-d'),
            'status' => 'borrowed'
        ];
        
        if ($this->loanModel->insert($loanData)) {
            return redirect()->to('/loan')->with('toast', 'Buku berhasil dipinjam');
        }
        
        return redirect()->back()->with('toast', 'Gagal meminjam buku');
    }
    
    private function canBorrowBook(int $bookId, int $userId): array
    {
        if (!$this->loanModel->isBookAvailable($bookId)) {
            return ['success' => false, 'message' => 'Buku sudah tidak tersedia'];
        }
        
        $activeLoans = $this->loanModel->getActiveLoansByUser($userId);
        if (count($activeLoans) >= 3) {
            return ['success' => false, 'message' => 'Anda sudah meminjam maksimal 3 buku'];
        }
        
        return ['success' => true, 'message' => 'OK'];
    }
    
    public function requestReturn($loanId)
    {
        $loan = $this->loanModel->find($loanId);
        
        if (!$loan) {
            return redirect()->to('/loan')->with('toast', 'Peminjaman tidak ditemukan');
        }
        
        if (session('role') !== 'user' || $loan['user_id'] != session('user_id')) {
            return redirect()->to('/loan')->with('toast', 'Anda tidak berhak mengembalikan buku ini');
        }
        
        if ($loan['status'] === 'returned') {
            return redirect()->to('/loan')->with('toast', 'Buku sudah dikembalikan');
        }
        
        if ($loan['return_requested']) {
            return redirect()->to('/loan')->with('toast', 'Permintaan pengembalian sudah diajukan');
        }
        
        $updateData = [
            'return_requested' => true,
            'return_requested_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->loanModel->update($loanId, $updateData)) {
            return redirect()->to('/loan')->with('toast', 'Permintaan pengembalian berhasil diajukan');
        } else {
            return redirect()->to('/loan')->with('toast', 'Gagal mengajukan permintaan pengembalian');
        }
    }
    
    public function confirmReturn($loanId)
    {
        if (session('role') !== 'admin') {
            return redirect()->to('/loan')->with('toast', 'Akses ditolak');
        }
        
        $loan = $this->loanModel->find($loanId);
        
        if (!$loan) {
            return redirect()->to('/loan')->with('toast', 'Peminjaman tidak ditemukan');
        }
        
        if ($loan['status'] === 'returned') {
            return redirect()->to('/loan')->with('toast', 'Buku sudah dikembalikan');
        }
        
        $updateData = [
            'status' => 'returned',
            'return_date' => date('Y-m-d'),
            'return_requested' => false
        ];
        
        if ($this->loanModel->update($loanId, $updateData)) {
            return redirect()->to('/loan')->with('toast', 'Pengembalian buku berhasil dikonfirmasi');
        } else {
            return redirect()->to('/loan')->with('toast', 'Gagal mengonfirmasi pengembalian');
        }
    }
    
    public function pendingReturns()
    {
        if (session('role') !== 'admin') {
            return redirect()->to('/loan')->with('toast', 'Akses ditolak');
        }
        
        $pendingReturns = $this->loanModel->getPendingReturnRequests();
        
        $data = [
            'loans' => $pendingReturns,
            'title' => 'Konfirmasi Pengembalian'
        ];
        
        return view('loan/pending_returns', $data);
    }
    
    public function rejectReturn($loanId)
    {
        if (session('role') !== 'admin') {
            return redirect()->to('/loan/pending-returns')->with('toast', 'Akses ditolak');
        }
        
        $loan = $this->loanModel->find($loanId);
        
        if (!$loan) {
            return redirect()->to('/loan/pending-returns')->with('toast', 'Peminjaman tidak ditemukan');
        }
        
        if (!$loan['return_requested']) {
            return redirect()->to('/loan/pending-returns')->with('toast', 'Tidak ada permintaan pengembalian untuk dibatalkan');
        }
        
        $updateData = [
            'return_requested' => false,
            'return_requested_at' => null
        ];
        
        if ($this->loanModel->update($loanId, $updateData)) {
            return redirect()->to('/loan/pending-returns')->with('toast', 'Permintaan pengembalian berhasil ditolak');
        } else {
            return redirect()->to('/loan/pending-returns')->with('toast', 'Gagal menolak permintaan pengembalian');
        }
    }

    public function delete($loanId)
    {
        if (session('role') !== 'admin') {
            return redirect()->to('/loan')->with('toast', 'Akses ditolak');
        }
        
        if (!$this->loanModel->find($loanId)) {
            return redirect()->to('/loan')->with('toast', 'Data peminjaman tidak ditemukan');
        }
        
        if ($this->loanModel->delete($loanId)) {
            return redirect()->to('/loan')->with('toast', 'Data peminjaman berhasil dihapus');
        }
        
        return redirect()->to('/loan')->with('toast', 'Gagal menghapus data peminjaman');
    }
}