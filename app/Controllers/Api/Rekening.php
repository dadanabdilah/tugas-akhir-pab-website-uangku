<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Rekening extends BaseController
{
    use ResponseTrait;
    
    public function index()
    {
        $rekening = $this->Rekening->select('rekening.*')
                                            ->where('id_pengguna', $this->request->id_pengguna)
                                            ->findAll();

        return $this->respond(['status' => 'success', 'data' => $rekening]);
    }

    public function add(){
        $id_pengguna = $this->request->id_pengguna;
        $jabatan     = $this->request->pengguna->jabatan; // Assuming the token has jabatan property

        $field = [
            'rekening' => 'Nama rekening harus diisi',
        ];

        if(!$this->validate([
            'rekening' => 'required',
        ])){
            return $this->respondCreated(['status' => 'failed', 'message' => $field[array_keys($this->validator->getErrors())[0]]]);
        }

        $request = [
            'rekening' => $this->request->getPost('rekening'),
            'saldo' => 0,
            'id_pengguna' => $id_pengguna,
        ];

        if($this->Rekening->save($request)){
            return $this->respondCreated(['status' => 'success', 'message' => 'Tambah Data Rekening Berhasil']);
        }else{
            return $this->respondCreated(['status' => 'failed', 'message' =>'Tambah Data Rekening Tidak Berhasil']);
        }
    }

    public function update(){
        $field = [
            'rekening' => 'Nama rekening harus diisi',
            'saldo' => 'Saldo harus diisi',
        ];

        if(!$this->validate([
            'id' => 'required',
            'rekening' => 'required',
        ])){
            return $this->respondCreated(['status' => 'failed', 'message' => $field[array_keys($this->validator->getErrors())[0]]]);
        }

        $request = [
            'id' => $this->request->getPost('id'),
            'rekening' => $this->request->getPost('rekening'),
            'id_pengguna' => $this->request->id_pengguna,
        ];

        if($this->Rekening->save($request)){
            return $this->respondCreated(['status' => 'success', 'message' => 'Edit Data Rekening Berhasil']);
        }else{
            return $this->respondCreated(['status' => 'failed', 'message' => 'Edit Data Rekening Tidak Berhasil']);
        }
    }

    public function delete($id = null){
        $this->Keuangan->where('id_rekening', $id)->delete();
        
        if($this->Rekening->where('id', $id)->delete()){
            return $this->respondCreated(['status' => 'success', 'message' => 'Hapus Data Rekening Berhasil']);
        }else{
            return $this->respondCreated(['status' => 'failed', 'message' => 'Hapus Data Rekening Tidak Berhasil']);
        }
    }
}
