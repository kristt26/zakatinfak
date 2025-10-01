<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pendaftaran extends BaseController
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
        $this->PendaftaranModel = new \App\Models\PendaftaranModel();
        $this->pengajuan = new \App\Models\PendaftaranModel();
        $this->biodata = new \App\Models\MustahikModel();
        $this->bantuan = new \App\Models\Jenis_bantuanModel();
        $this->persyaratan = new \App\Models\PersyaratanModel();
        $this->kelengkapan = new \App\Models\KelengkapanModel();
        $this->lib = new \App\Libraries\Decode();
    }

    public function index(): string
    {
        return view('admin/pendaftaran');
    }

    public function detail($id): string
    {
        return view('admin/detail_pengajuan');
    }

    public function store()
    {
        $data = $this->PendaftaranModel->select('pendaftaran.*, jenis_bantuan.nama_bantuan, mustahik.nama, mustahik.telepon')
            ->join('mustahik', 'mustahik.id=pendaftaran.id_mustahik', 'left')
            ->join('jenis_bantuan', 'jenis_bantuan.id=pendaftaran.id_jenis_bantuan', 'left')
            ->orderBy('pendaftaran.id', 'desc')
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function storeDetail($id)
    {
        try {
            $data['pengajuan'] = $this->pengajuan->select('pendaftaran.*, jenis_bantuan.nama_bantuan')
                ->join('mustahik', 'mustahik.id=pendaftaran.id_mustahik', 'left')
                ->join('jenis_bantuan', 'jenis_bantuan.id=pendaftaran.id_jenis_bantuan', 'left')
                ->where('pendaftaran.id', $id)
                ->orderBy('pendaftaran.id', 'desc')
                ->first();
            $data['biodata'] = $this->biodata->where('id', $data['pengajuan']->id_mustahik)->first();
            $data['bantuan'] = $this->bantuan->where('id', $data['pengajuan']->id_jenis_bantuan)->first();
            $data['bantuan']->persyaratan = $this->persyaratan->select('persyaratan.*, kelengkapan.file, kelengkapan.id as id_kelengkapan')
                ->join('kelengkapan', 'kelengkapan.id_persyaratan=persyaratan.id', 'left')
                ->where('id_jenis_bantuan', $data['bantuan']->id)->findAll();
            return $this->response->setJSON($data);
        } catch (\Throwable $th) {
            return $this->response->setJSON($data);
        }
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->PendaftaranModel->insert($param);
            $param->id = $this->PendaftaranModel->insertID();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
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
