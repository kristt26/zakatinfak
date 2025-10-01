<?php

namespace App\Controllers\Mustahik;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pengajuan extends BaseController
{
    protected $pengajuan;
    protected $biodata;
    protected $bantuan;
    protected $persyaratan;
    protected $kelengkapan;
    protected $rekom;
    protected $lib;

    public function __construct()
    {
        $this->pengajuan = new \App\Models\PendaftaranModel();
        $this->biodata = new \App\Models\MustahikModel();
        $this->bantuan = new \App\Models\Jenis_bantuanModel();
        $this->persyaratan = new \App\Models\PersyaratanModel();
        $this->kelengkapan = new \App\Models\KelengkapanModel();
        $this->rekom = new \App\Models\RekomendasiModel();
        $this->lib = new \App\Libraries\Decode();
    }

    public function index(): string
    {
        return view('mustahik/daftar_pengajuan');
    }

    public function tambah(): string
    {
        return view('mustahik/pengajuan');
    }

    public function ubah($id): string
    {
        return view('mustahik/ubah_pengajuan');
    }

    public function store()
    {
        $data = $this->pengajuan->select('pendaftaran.*, jenis_bantuan.nama_bantuan')
        ->join('mustahik', 'mustahik.id=pendaftaran.id_mustahik', 'left')
        ->join('jenis_bantuan', 'jenis_bantuan.id=pendaftaran.id_jenis_bantuan', 'left')
        ->where('mustahik.id_users', session()->get('user_id'))
        ->orderBy('pendaftaran.id', 'desc')
        ->findAll();
        foreach ($data as $key => $value) {
            $value->rekomendasi =  $this->rekom->select("rekomendasi.*, kriteria.nama_kriteria, kriteria.bobot")->join('kriteria', 'kriteria.id = rekomendasi.id_kriteria', 'left')->where('id_pendaftaran', $value->id)->findAll();
        }
        return $this->response->setJSON($data);
    }

    public function storeAddPengajuan()
    {
        $data['biodata'] = $this->biodata->where('id_users', session('user_id'))->first();
        $data['bantuan'] = $this->bantuan->findAll();
        foreach ($data['bantuan'] as $key => $value) {
            $value->persyaratan = $this->persyaratan->where('id_jenis_bantuan', $value->id)->findAll();
        }
        $data['pengajuan'] = $this->pengajuan->select('pendaftaran.*, jenis_bantuan.nama_bantuan')
        ->join('mustahik', 'mustahik.id=pendaftaran.id_mustahik', 'left')
        ->join('jenis_bantuan', 'jenis_bantuan.id=pendaftaran.id_jenis_bantuan', 'left')
        ->where('id_users', session()->get('id_user'))
        ->orderBy('pendaftaran.id', 'desc')
        ->findAll();
        return $this->response->setJSON($data);
    }

    public function storeEditPengajuan($id)
    {
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
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        $conn = \Config\Database::connect();
        try {
            $conn->transException(true)->transStart();
            $daftar = [
                'no_daftar'=>$param->no_daftar,
                'id_mustahik'=>$param->id_mustahik,
                'id_jenis_bantuan'=>$param->id_jenis_bantuan,
                'alasan'=>$param->alasan,
                'tanggal_daftar'=>date("Y-m-d"),
                'status_pengajuan'=>"diajukan"
            ];
            $this->pengajuan->insert($daftar);
            $id_pendaftaran = $this->pengajuan->getInsertID();
            $kelengkapan = [];
            foreach ($param->kelengkapan as $key => $value) {
                $item = [
                    'id_persyaratan'=>$value->id,
                    'file'=>$this->lib->decodebase64($value->berkas->base64),
                    'id_pendaftaran'=>$id_pendaftaran
                ];
                $kelengkapan[] = $item;
            }
            $this->kelengkapan->insertBatch($kelengkapan);
            $conn->transComplete();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            $conn->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function edit(): ResponseInterface
    {
        $param = $this->request->getJSON();
        $conn = \Config\Database::connect();
        try {
            $conn->transException(true)->transStart();
            foreach ($param->persyaratan as $key => $value) {
                $value->file = isset($value->berkas) ? $this->lib->decodebase64($value->berkas->base64, $value->file): $value->file;
                $this->kelengkapan->update($value->id_kelengkapan, $value);
            }
            $this->pengajuan->update($param->id, ['pesan'=>null]);
            $conn->transComplete();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            $conn->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
