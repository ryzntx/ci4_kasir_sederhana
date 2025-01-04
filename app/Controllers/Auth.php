<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->back();
        }
        return view('pages/auth/login');
    }

    public function process()
    {
        $session   = session();
        $userModel = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user[ 'password' ])) {
                // Set session
                $session->set([
                    'user_id'   => $user[ 'id_user' ],
                    'email'     => $user[ 'email' ],
                    'jabatan'   => $user[ 'jabatan' ],
                    'logged_in' => true,
                 ]);

                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
