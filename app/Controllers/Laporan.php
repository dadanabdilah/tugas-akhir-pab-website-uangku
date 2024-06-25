<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function catatan()
    {
        if(session()->get('jabatan') == 'Admin'){
            $data = [
                'Kategori' => $this->Kategori->findAll(),
                'Rekening' => $this->Rekening->findAll(),
                'Keuangan' => $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*, pengguna.nama_pengguna')
                                                ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                                ->join('pengguna', 'pengguna.id = kategori.id_pengguna')
                                                ->findAll()
            ];
        } else {
            $data = [
                'Kategori' => $this->Kategori->where('id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)->findAll(),
                'Rekening' => $this->Rekening->where('id_pengguna', $this->Pengguna->where('email', session('email'))->first()->id)->findAll(),
                'Keuangan' => $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*, pengguna.nama_pengguna')
                                            ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                            ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                            ->join('pengguna', 'pengguna.id = kategori.id_pengguna')
                                            ->where('rekening.id_pengguna', session()->get('id_pengguna'))
                                            ->findAll()
            ];
        }
        return view("laporan/keuangan", $data);
    }

    public function export($action = ""){
        if($action == "keuangan"){
            if($_POST){
                if(session()->get('jabatan') == 'Admin'){
                    if($this->request->getPost('jenis') != "Semua"){
                        $Keuangan = $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*, pengguna.nama_pengguna')
                                                    ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                                    ->join('pengguna', 'pengguna.id = kategori.id_pengguna')
                                                    ->where('keuangan.jenis', str_replace(' ', '_', $this->request->getPost('jenis')))
                                                    ->where('tanggal BETWEEN "'.$this->request->getPost('tanggal_awal').'" AND "'.$this->request->getPost('tanggal_akhir').'" ')
                                                    ->orderBy('kategori.id_pengguna')
                                                    ->findAll();
                    } else if ($this->request->getPost('jenis') == "Semua"){
                        $Keuangan = $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*, pengguna.nama_pengguna')
                                                    ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                                    ->join('pengguna', 'pengguna.id = kategori.id_pengguna')
                                                    ->where('tanggal BETWEEN "'.$this->request->getPost('tanggal_awal').'" AND "'.$this->request->getPost('tanggal_akhir').'" ')
                                                    ->orderBy('kategori.id_pengguna')
                                                    ->findAll();
                    }
                } else {
                    if($this->request->getPost('jenis') != "Semua"){
                        $Keuangan = $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*')
                                                    ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                                    ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                                    ->where('keuangan.jenis', str_replace(' ', '_', $this->request->getPost('jenis')))
                                                    ->where('rekening.id_pengguna', session()->get('id_pengguna'))
                                                    ->where('tanggal BETWEEN "'.$this->request->getPost('tanggal_awal').'" AND "'.$this->request->getPost('tanggal_akhir').'" ')
                                                    ->findAll();
                    } else if ($this->request->getPost('jenis') == "Semua"){
                        $Keuangan = $this->Keuangan->select('keuangan.*, keuangan.id AS id_keuangan, kategori.*')
                                                    ->join('kategori', 'kategori.id = keuangan.id_kategori')
                                                    ->join('rekening', 'rekening.id = keuangan.id_rekening')
                                                    ->where('rekening.id_pengguna', session()->get('id_pengguna'))
                                                    ->where('tanggal BETWEEN "'.$this->request->getPost('tanggal_awal').'" AND "'.$this->request->getPost('tanggal_akhir').'" ')
                                                    ->findAll();
                    }
                }

                $data = [
                            'Keuangan'      => $Keuangan,
                            'tanggal_awal'  => $this->request->getPost('tanggal_awal'),
                            'tanggal_akhir' => $this->request->getPost('tanggal_akhir'),
                        ];
                // return view('laporan/keuangan_pdf', $data);
                $dompdf = new \Dompdf\Dompdf(); 
                $dompdf->loadHtml(view('laporan/keuangan_pdf', $data));
                $dompdf->setPaper('A4', 'potrait');
                $dompdf->render();
                $dompdf->stream("Laporan Keuangan Periode " . $this->request->getPost('tanggal_awal') . "-" . $this->request->getPost('tanggal_akhir') . ".pdf");
            } else {
                session()->setFlashdata('error', 'Data tidak ditemukan cek filter anda!');
                return redirect()->to('laporan/nilai');
            }
        }
    }
}
