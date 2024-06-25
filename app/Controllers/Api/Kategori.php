<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Kategori extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $id_pengguna = $this->request->id_pengguna;
    
        $kategori = $this->Kategori->select('kategori.*')
            ->where('id_pengguna', $id_pengguna)
            ->orderBy('id_pengguna')
            ->findAll();
            
        return $this->respond(['status' => 'success', 'data' => $kategori]);
    }

    public function add()
    {
        $field = [
            'kategori' => 'Kategori harus diisi',
            'jenis' => 'Jenis harus diisi',
        ];

        if (!$this->validate([
            'kategori' => 'required',
            'jenis' => 'required',
        ])) {
            return $this->respondCreated(['status' => 'failed', 'message' => $field[array_keys($this->validator->getErrors())[0]]]);
        }

        $request = [
            'kategori' => $this->request->getPost('kategori'),
            'jenis' => $this->request->getPost('jenis'),
            'id_pengguna' => $this->request->id_pengguna,
        ];

        if ($this->Kategori->save($request)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Tambah Data Kategori Berhasil']);
        } else {
            return $this->respondCreated(['status' => 'failed', 'message' => 'Tambah Data Kategori Tidak Berhasil']);
        }
    }

    public function update()
    {
        $field = [
            'kategori' => 'Kategori harus diisi',
            'jenis' => 'Jenis harus diisi',
        ];

        if (!$this->validate([
            'kategori' => 'required',
            'jenis' => 'required',
        ])) {
            return $this->respondCreated(['status' => 'failed', 'message' => $field[array_keys($this->validator->getErrors())[0]]]);
        }

        $request = [
            'id' => $this->request->getPost('id'),
            'kategori' => $this->request->getPost('kategori'),
            'jenis' => $this->request->getPost('jenis'),
            'id_pengguna' => $this->request->id_pengguna,
        ];

        if ($this->Kategori->save($request)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Edit Data Kategori Berhasil']);
        } else {
            return $this->respondCreated(['status' => 'failed', 'message' => 'Edit Data Kategori Tidak Berhasil']);
        }
    }

    public function delete($id = null)
    {
        if ($this->Kategori->where('id', $id)->where('id_pengguna', $this->request->id_pengguna)->delete()) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Hapus Data Kategori Berhasil']);
        } else {
            return $this->respondCreated(['status' => 'failed', 'message' => 'Hapus Data Kategori Tidak Berhasil']);
        }
    }
}
