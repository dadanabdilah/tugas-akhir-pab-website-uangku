<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pengguna extends BaseController
{
    public function index()
    {
        $data = [
            'Pengguna' => $this->Pengguna->findAll()
        ];
        return view("pengguna/index", $data);
    }
    
    public function insert(){
        if(!$this->validate([
            'nama_pengguna' => 'required',
            'email' => 'required|is_unique[pengguna.email]',
            'password' => 'required',
            'jabatan' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'jabatan' => $this->request->getPost('jabatan'),
        ];


        $result = $this->Pengguna->save($request);

        if($result){
            session()->setFlashdata('message', 'Tambah Data Pengguna Berhasil');
        }else{
            session()->setFlashdata('error', 'Tambah Data Pengguna Tidak Berhasil');
        }

        return redirect()->to('pengguna');
    }

    public function update(){
        if(!$this->validate([
            'nama_pengguna' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'id' => $this->request->getPost('id'),
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'email' => $this->request->getPost('email'),
            'jabatan' => $this->request->getPost('jabatan'),
        ];

        if($this->request->getPost('password')){
            $pass = $this->request->getPost('password');
            $request  = array_merge($request, ['password' => md5($pass)]);
        }


        $result = $this->Pengguna->save($request);

        if($result){
            session()->setFlashdata('message', 'Edit Data Pengguna Berhasil');
        }else{
            session()->setFlashdata('error', 'Edit Data Pengguna Tidak Berhasil');
        }

        return redirect()->to('pengguna');
    }

    public function delete($id = null){
        $result = $this->Pengguna->where('id', $id)->delete();
        $this->Rekening->where('id_pengguna', $id)->delete();
        $this->Kategori->where('id_pengguna', $id)->delete();
        $this->Keuangan->where('id_pengguna', $id)->delete();
        
        if($result){
            session()->setFlashdata('message', 'Hapus Data Pengguna Berhasil');
        }else{
            session()->setFlashdata('error', 'Hapus Data Pengguna Tidak Berhasil');
        }

        return redirect()->to('pengguna');
    }
}
