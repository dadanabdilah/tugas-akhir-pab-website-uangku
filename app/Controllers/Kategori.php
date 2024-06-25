<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kategori extends BaseController
{
    public function index()
    {
        if(session()->get('jabatan') == 'Admin'){
            $data = [
                'Kategori' => $this->Kategori->select('kategori.*, pengguna.nama_pengguna')->join('pengguna', 'pengguna.id = kategori.id_pengguna')->orderBy('id_pengguna')->findAll(),
                'Pengguna' => $this->Pengguna->findAll()
            ];
        } else {
            $data = [
                'Kategori' => $this->Kategori->select('kategori.*')
                                        ->where('id_pengguna', session()->get('id_pengguna'))
                                        ->orderBy('id_pengguna')->findAll(),
                'Pengguna' => $this->Pengguna->findAll()
            ];
        }
        return view("kategori/index", $data);
    }
    
    public function insert(){
        if(!$this->validate([
            'kategori' => 'required',
            'jenis' => 'required',
            'id_pengguna' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'jenis' => $this->request->getPost('jenis'),
            'kategori' => $this->request->getPost('kategori'),
            'id_pengguna' => $this->request->getPost('id_pengguna'),
        ];


        $result = $this->Kategori->save($request);

        if($result){
            session()->setFlashdata('message', 'Tambah Data Kategori Berhasil');
        }else{
            session()->setFlashdata('error', 'Tambah Data Kategori Tidak Berhasil');
        }

        return redirect()->to('kategori');
    }

    public function update(){
        if(!$this->validate([
            'kategori' => 'required',
            'jenis' => 'required',
            'id_pengguna' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'id' => $this->request->getPost('id'),
            'jenis' => $this->request->getPost('jenis'),
            'kategori' => $this->request->getPost('kategori'),
            'id_pengguna' => $this->request->getPost('id_pengguna'),
        ];

        $result = $this->Kategori->save($request);

        if($result){
            session()->setFlashdata('message', 'Edit Data Kategori Berhasil');
        }else{
            session()->setFlashdata('error', 'Edit Data Kategori Tidak Berhasil');
        }

        return redirect()->to('kategori');
    }

    public function delete($id = null){
        $result = $this->Kategori->where('id', $id)->delete();

        if($result){
            session()->setFlashdata('message', 'Hapus Data Kategori Berhasil');
        }else{
            session()->setFlashdata('error', 'Hapus Data Kategori Tidak Berhasil');
        }

        return redirect()->to('kategori');
    }
}
