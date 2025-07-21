<?php
namespace App\Controllers;

use App\Models\User;
use App\Validation\AuthValidation;
use CodeIgniter\Controller;

class Auth extends Controller
{

    protected $helpers = ['form'];

    public function login()
    {
        return view('auth/login', [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function login_process()
    {
        $validation = \Config\Services::validation();
        $validation->setRules(AuthValidation::getLoginRules(), AuthValidation::getLoginMessages());

        if (!$validation->withRequest($this->request)->run()) {
            return view('auth/login', ['validation' => $validation]);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        if ($this->authenticateUser($username, $password)) {
            return redirect()->to($this->getRedirectUrl())->with('toast', 'Login berhasil!');
        }
        
        return view('auth/login', [
            'validation' => $validation,
            'toast' => 'Username atau password salah!'
        ]);
    }
    
    private function authenticateUser(string $username, string $password): bool
    {
        $userModel = new User();
        $user = $userModel->where('username', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            return true;
        }
        
        return false;
    }
    
    private function getRedirectUrl(): string
    {
        return session('role') === 'admin' ? '/admin' : '/buku';
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('toast', 'Logout berhasil!');
    }
}