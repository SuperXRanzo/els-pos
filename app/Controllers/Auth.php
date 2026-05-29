<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController {
    public function index() {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
        return view('login');
    }

    public function login() {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'name' => $user['name'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('dashboard');
            }
        }
        
        $session->setFlashdata('msg', 'Username atau Password salah!');
        return redirect()->to('/');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/');
    }
}