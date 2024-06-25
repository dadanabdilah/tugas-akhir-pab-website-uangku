<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Keuangan extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $id_pengguna = $this->request->id_pengguna;
        $keuangan = $this->Keuangan->select('keuangan.*, kategori.kategori, rekening.rekening, pengguna.nama_pengguna')
            ->join('kategori', 'kategori.id = keuangan.id_kategori')
            ->join('rekening', 'rekening.id = keuangan.id_rekening')
            ->join('pengguna', 'pengguna.id = kategori.id_pengguna')
            ->where('rekening.id_pengguna', $this->request->id_pengguna)
            ->orderBy('tanggal')
            ->findAll();

        return $this->respond(['status' => 'success', 'data' => $keuangan]);
    }

    public function info(){
        $data = [
            'Saldo'      => (int) $this->Rekening->select('SUM(saldo) AS saldo')
                                            ->where('id_pengguna', $this->request->id_pengguna)
                                            ->first()->saldo,
            'UangMasuk'  => (int) $this->Keuangan->select('SUM(nominal) AS nominal')
                                            ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                            ->where('jenis', 'Uang_Masuk')
                                            ->where('rekening.id_pengguna', $this->request->id_pengguna)
                                            ->first()->nominal,
            'UangKeluar' => (int) $this->Keuangan->select('SUM(nominal) AS nominal')
                                            ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                            ->where('jenis', 'Uang_Keluar')
                                            ->where('rekening.id_pengguna', $this->request->id_pengguna)
                                            ->first()->nominal,
        ];

        return $this->respond(['status' => 'success', 'data' => $data]);
    }

    public function add()
    {
        $field = [
            'jenis' => 'Jenis harus diisi',
            'kategori' => 'Kategori harus diisi',
            'rekening' => 'Rekening harus diisi',
            'nominal' => 'Nominal harus diisi',
            'keterangan' => 'Keterangan harus diisi',
            'tanggal' => 'Tanggal harus diisi',
        ];

        if (!$this->validate([
            'jenis' => 'required',
            'kategori' => 'required',
            'rekening' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
        ])) {
            return $this->respondCreated(['status' => 'failed', 'message' => $field[array_keys($this->validator->getErrors())[0]]]);
        }

        $rekening = $this->Rekening->where('rekening', $this->request->getPost('rekening'))->where('rekening.id_pengguna', $this->request->id_pengguna)->first();
        $kategori = $this->Kategori->where('kategori', $this->request->getPost('kategori'))->where('kategori.id_pengguna', $this->request->id_pengguna)->first();

        $request = [
            'jenis' => str_replace(' ', '_', $this->request->getPost('jenis')),
            'id_kategori' => $kategori->id,
            'id_rekening' => $rekening->id,
            'nominal' => $this->request->getPost('nominal'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
        ];

        $rekening = $this->Rekening->where('id', $request['id_rekening'])->first();
        if ($request['jenis'] == 'Uang_Masuk') {
            $rekening->saldo += (int) $request['nominal'];
        } else {
            $rekening->saldo -= (int) $request['nominal'];
        }
        $this->Rekening->save($rekening);

        if ($this->Keuangan->save($request)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Tambah Catatan Keuangan Berhasil']);
        } else {
            return $this->respondCreated(['status' => 'failed', 'message' => 'Tambah Catatan Keuangan Tidak Berhasil']);
        }
    }

    public function update()
    {
        $field = [
            'jenis' => 'Jenis harus diisi',
            'kategori' => 'Kategori harus diisi',
            'rekening' => 'Rekening harus diisi',
            'nominal' => 'Nominal harus diisi',
            'keterangan' => 'Keterangan harus diisi',
            'tanggal' => 'Tanggal harus diisi',
        ];

        if (!$this->validate([
            'jenis' => 'required',
            'kategori' => 'required',
            'rekening' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
        ])) {
            return $this->respondCreated(['status' => 'failed', 'message' => $field[array_keys($this->validator->getErrors())[0]]]);
        }

        $rekening = $this->Rekening->where('rekening', $this->request->getPost('rekening'))->where('rekening.id_pengguna', $this->request->id_pengguna)->first();
        $kategori = $this->Kategori->where('kategori', $this->request->getPost('kategori'))->where('kategori.id_pengguna', $this->request->id_pengguna)->first();

        $request = [
            'id' => $this->request->getPost('id'),
            'jenis' => $this->request->getPost('jenis'),
            'id_kategori' => $kategori->id,
            'id_rekening' => $rekening->id,
            'nominal' => $this->request->getPost('nominal'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
        ];


        if($request['jenis'] == 'Uang_Masuk'){
            $this->Rekening->save([
                'id' => $request['id_rekening'],
                'saldo' => ((int) $this->Rekening->where('id', $request['id_rekening'])->first()->saldo - (int) $this->request->getPost('old_nominal')) + (int) $request['nominal'],
            ]);
        } else {
            $this->Rekening->save([
                'id' => $request['id_rekening'],
                'saldo' => ((int) $this->Rekening->where('id', $request['id_rekening'])->first()->saldo + (int) $this->request->getPost('old_nominal')) - (int) $request['nominal'] ,
            ]);
        }


        if ($this->Keuangan->save($request)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Edit Catatan Keuangan Berhasil']);
        } else {
            return $this->respondCreated(['status' => 'failed', 'message' => 'Edit Catatan Keuangan Tidak Berhasil']);
        }
    }

    public function delete($id = null)
    {
        $data = $this->Keuangan->where('id', $id)->where('rekening.id_pengguna', $this->request->id_pengguna)->first();

        $rekening = $this->Rekening->where('id', $data->id_rekening)->where('rekening.id_pengguna', $this->request->id_pengguna)->first();
        if ($data->jenis == 'Uang_Masuk') {
            $rekening->saldo -= (int) $data->nominal;
        } else {
            $rekening->saldo += (int) $data->nominal;
        }
        $this->Rekening->save($rekening);

        if ($this->Keuangan->where('id', $id)->delete()) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Hapus Catatan Keuangan Berhasil']);
        } else {
            return $this->respondCreated(['status' => 'failed', 'message' => 'Hapus Catatan Keuangan Tidak Berhasil']);
        }
    }

    public function kategori($jenis)
    {
        $Kategori = $this->Kategori->where('jenis', $jenis)->where('id_pengguna', $this->request->id_pengguna)->findAll();

        return $this->respond(['status' => 'success', 'data' => $Kategori]);
    }
}
