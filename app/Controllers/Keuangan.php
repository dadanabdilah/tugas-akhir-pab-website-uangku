<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Keuangan extends BaseController
{
    public function index()
    {
        if(session()->get('jabatan') == 'Admin'){
            $data = [
                'Kategori' => $this->Kategori->findAll(),
                'Rekening' => $this->Rekening->findAll(),
                'Keuangan' => $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*, rekening.rekening, pengguna.nama_pengguna')
                                            ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                            ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                            ->join('pengguna', 'pengguna.id = kategori.id_pengguna')
                                            ->orderBy('tanggal')
                                            ->findAll()
            ];
        } else {
            $data = [
                'Kategori' => $this->Kategori->where('id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)->findAll(),
                'Rekening' => $this->Rekening->where('id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)->findAll(),
                'Keuangan' => $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*, rekening.rekening, pengguna.nama_pengguna')
                                            ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                            ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                            ->join('pengguna', 'pengguna.id = kategori.id_pengguna')
                                            ->where('rekening.id_pengguna', session()->get('id_pengguna'))
                                            ->orderBy('tanggal')
                                            ->findAll()
            ];
        }
        return view("keuangan/index", $data);
    }
    
    public function insert(){
        if(!$this->validate([
            'jenis' => 'required',
            'id_kategori' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'jenis' => $this->request->getPost('jenis'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_rekening' => $this->request->getPost('id_rekening'),
            'nominal' => $this->request->getPost('nominal'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
        ];

        if($request['jenis'] == 'Uang_Masuk'){
            $this->Rekening->save([
                'id' => $request['id_rekening'],
                'saldo' => (int) $this->Rekening->where('id', $request['id_rekening'])->first()->saldo + (int) $request['nominal'],
            ]);
        } else {
            $this->Rekening->save([
                'id' => $request['id_rekening'],
                'saldo' => (int) $this->Rekening->where('id', $request['id_rekening'])->first()->saldo - (int) $request['nominal'],
            ]);
        }


        $result = $this->Keuangan->save($request);

        if($result){
            session()->setFlashdata('message', 'Tambah Catatan Keuangan Berhasil');
        }else{
            session()->setFlashdata('error', 'Tambah Catatan Keuangan Tidak Berhasil');
        }

        return redirect()->to('keuangan');
    }

    public function update(){
        if(!$this->validate([
            'jenis' => 'required',
            'id_kategori' => 'required',
            'nominal' => 'required',
            'old_nominal' => 'required', // add this line
            'keterangan' => 'required',
            'tanggal' => 'required',
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = [
            'id' => $this->request->getPost('id'),
            'jenis' => $this->request->getPost('jenis'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_rekening' => $this->request->getPost('id_rekening'),
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

        $result = $this->Keuangan->save($request);

        if($result){
            session()->setFlashdata('message', 'Edit Catatan Keuangan Berhasil');
        }else{
            session()->setFlashdata('error', 'Edit Catatan Keuangan Tidak Berhasil');
        }

        return redirect()->to('keuangan');
    }

    public function delete($id = null){
        $data = $this->Keuangan->where('id', $id)->first();

        if($data->jenis == 'Uang_Masuk'){
            $this->Rekening->save([
                'id' => $data->id_rekening,
                'saldo' => (int) $this->Rekening->where('id', $data->id_rekening)->first()->saldo - (int) $data->nominal,
            ]);
        } else {
            $this->Rekening->save([
                'id' => $data->id_rekening,
                'saldo' => (int) $this->Rekening->where('id', $data->id_rekening)->first()->saldo + (int) $data->nominal,
            ]);
        }

        $result = $this->Keuangan->where('id', $id)->delete();

        if($result){
            session()->setFlashdata('message', 'Hapus Catatan Keuangan Berhasil');
        }else{
            session()->setFlashdata('error', 'Hapus Catatan Keuangan Tidak Berhasil');
        }

        return redirect()->to('keuangan');
    }

    public function kategori($jenis){
        $html = '<option selected="selected" disabled>Pilih</option>';
        if(session()->get('jabatan') == 'Admin'){
            $Kategori = $this->Kategori->where('jenis', $jenis)->findAll();
        } else {
            $Kategori = $this->Kategori->where('jenis', $jenis)->where('id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)->findAll();    
        }

        foreach ($Kategori as $key => $value) {
            $html .= '<option value="' . $value->id . '">' . $value->kategori . '</option>';
        }

        return $html;
    }
}
