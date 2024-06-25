<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        if($_POST){
            if(!$this->validate([
                'email' => 'required',
                'password' => 'required',
            ])){
                session()->setFlashdata('error', $this->validator->listErrors());
    
                return redirect()->back()->withInput();
            } else {
                $request = [
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                ];
        
                $result = $this->Pengguna->where('email', $request['email'])->first();
                if($result){
                    $pass = md5($request['password']);
                    $pengguna = $this->Pengguna->where('email', $request['email'])->where('password', $pass)->first();
                    if($pengguna){
                        $session_data = [
                            'id_pengguna' => $pengguna->id,
                            'email'		=> $request['email'],
                            'nama_pengguna' => $pengguna->nama_pengguna,
                            'jabatan' => $pengguna->jabatan,
                            'sudah_login'   => TRUE
                        ];
    
                        $this->session->set($session_data);

                        session()->setFlashdata('message', 'Selamat, Login Berhasil');
                        return redirect()->to('dashboard');
                    }else{
                        session()->setFlashdata('error', 'Password Anda Salah!');
                        return redirect()->to('login');
                    }
                }else{
                    session()->setFlashdata('error', 'Email Belum Terdaftar!');
                    return redirect()->to('login');
                }
        
            }
        }

        return view('auth/login');
    }

    public function logout(){
        session()->destroy();
        session()->setFlashdata('message', 'Berhasil logout!');
        return redirect()->to('/');
	}
}
