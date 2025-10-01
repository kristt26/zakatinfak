<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Zakat extends BaseController
{
    protected $PendaftaranModel;
    protected $pengajuan;
    protected $biodata;
    protected $bantuan;
    protected $persyaratan;
    protected $kelengkapan;
    protected $lib;

    public function __construct()
    {
        $this->PendaftaranModel = new \App\Models\ZakatModel();
        $this->pengajuan = new \App\Models\ZakatModel();
        $this->biodata = new \App\Models\MustahikModel();
        $this->bantuan = new \App\Models\Jenis_bantuanModel();
        $this->persyaratan = new \App\Models\PersyaratanModel();
        $this->kelengkapan = new \App\Models\KelengkapanModel();
        $this->lib = new \App\Libraries\Decode();
    }

    public function index(): string
    {
        return view('admin/pembayaran');
    }

    public function store()
    {
        $data = $this->PendaftaranModel
            ->select('zakat.*, kategori_zis.nama_kategori, muzaki.nama as nama_muzaki, muzaki.telepon as telepon_muzaki, mustahik.nama as nama_mustahik, mustahik.telepon as telepon_mustahik')
            ->join('muzaki', 'muzaki.id = zakat.id_muzaki', 'left')
            ->join('mustahik', 'mustahik.id = zakat.id_mustahik', 'left')
            ->join('kategori_zis', 'kategori_zis.id = zakat.id_kategori', 'left')
            ->orderBy('kategori_zis.id', 'desc')
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function edit(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->PendaftaranModel->update($param->id, $param);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function delete($id = null): ResponseInterface
    {
        try {
            $this->PendaftaranModel->delete($id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(500);
        }
    }
}
