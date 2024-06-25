<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Rekening extends BaseController
{
    public function index()
    {
        if(session()->get('jabatan') == 'Admin'){
            $data = [
                'Rekening' => $this->Rekening->select('rekening.*, pengguna.nama_pengguna')
                                                ->join('pengguna', 'pengguna.id = rekening.id_pengguna')
                                                ->findAll(),
                'Pengguna' => $this->Pengguna->findAll()
            ];
        } else {
            $data = [
                'Rekening' => $this->Rekening->select('rekening.*')
                                                ->where('id_pengguna', session()->get('id_pengguna'))
                                                ->findAll(),
                'Pengguna' => $this->Pengguna->findAll()
            ];
        }
        return view("rekening/index", $data);
    }
    
    public function insert(){
        if(!$this->validate([
            'rekening' => 'required',
            'id_pengguna' => 'required',
            'saldo' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'rekening' => $this->request->getPost('rekening'),
            'saldo' => $this->request->getPost('saldo'),
            'id_pengguna' => $this->request->getPost('id_pengguna'),
        ];


        $result = $this->Rekening->save($request);

        if($result){
            session()->setFlashdata('message', 'Tambah Data Rekening Berhasil');
        }else{
            session()->setFlashdata('error', 'Tambah Data Rekening Tidak Berhasil');
        }

        return redirect()->to('rekening');
    }

    public function update(){
        if(!$this->validate([
            'rekening' => 'required',
            'id_pengguna' => 'required',
            'saldo' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'id' => $this->request->getPost('id'),
            'rekening' => $this->request->getPost('rekening'),
            'saldo' => $this->request->getPost('saldo'),
            'id_pengguna' => $this->request->getPost('id_pengguna'),
        ];

        $result = $this->Rekening->save($request);

        if($result){
            session()->setFlashdata('message', 'Edit Data Rekening Berhasil');
        }else{
            session()->setFlashdata('error', 'Edit Data Rekening Tidak Berhasil');
        }

        return redirect()->to('rekening');
    }

    public function delete($id = null){
        $result = $this->Rekening->where('id', $id)->delete();

        if($result){
            session()->setFlashdata('message', 'Hapus Data Rekening Berhasil');
        }else{
            session()->setFlashdata('error', 'Hapus Data Rekening Tidak Berhasil');
        }

        return redirect()->to('rekening');
    }
}
