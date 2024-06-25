<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if(session()->get('jabatan') == 'Admin'){
            $data = [
                'Saldo'      => $this->Rekening->select('SUM(saldo) AS saldo')->first()->saldo,
                'Pengguna'   => $this->Pengguna->countAllResults(),
                'UangMasuk'  => $this->Keuangan->select('SUM(nominal) AS nominal')
                                                ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                                ->where('jenis', 'Uang_Masuk')
                                                ->first()->nominal,
                'UangKeluar' => $this->Keuangan->select('SUM(nominal) AS nominal')
                                                ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                                ->where('jenis', 'Uang_Keluar')
                                                ->first()->nominal,
            ];
        } else {
            $data = [
                'Saldo'      => $this->Rekening->select('SUM(saldo) AS saldo')
                                                ->where('id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)
                                                ->first()->saldo,
                'Pengguna'   => $this->Pengguna->countAllResults(),
                'UangMasuk'  => $this->Keuangan->select('SUM(nominal) AS nominal')
                                                ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                                ->where('jenis', 'Uang_Masuk')
                                                ->where('rekening.id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)
                                                ->first()->nominal,
                'UangKeluar' => $this->Keuangan->select('SUM(nominal) AS nominal')
                                                ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                                ->where('jenis', 'Uang_Keluar')
                                                ->where('rekening.id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)
                                                ->first()->nominal,
            ];
        }
        return view('dashboard/index', $data);
    }
}
