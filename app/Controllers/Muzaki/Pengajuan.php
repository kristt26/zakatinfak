<?php

namespace App\Controllers\Muzaki;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Pengajuan extends BaseController
{
    use ResponseTrait;
    protected $pengajuan;
    protected $biodata;
    protected $bantuan;
    protected $persyaratan;
    protected $kelengkapan;
    protected $rekom;
    protected $lib;

    public function __construct()
    {
        $this->pengajuan = new \App\Models\ZakatModel();
        $this->biodata = new \App\Models\MuzakiModel();
        $this->bantuan = new \App\Models\Kategori_zisModel();
        $this->persyaratan = new \App\Models\PersyaratanModel();
        $this->kelengkapan = new \App\Models\KelengkapanModel();
        $this->rekom = new \App\Models\RekomendasiModel();
        $this->lib = new \App\Libraries\Decode();
    }

    public function index(): string
    {
        return view('muzaki/daftar_pengajuan');
    }

    public function tambah(): string
    {
        return view('muzaki/pengajuan');
    }

    public function ubah($id): string
    {
        return view('muzaki/ubah_pengajuan');
    }

    public function store()
    {
        $data = $this->pengajuan->select('zakat.*, kategori_zis.nama_kategori')
            ->join('muzaki', 'muzaki.id=zakat.id_muzaki', 'left')
            ->join('kategori_zis', 'kategori_zis.id=zakat.id_kategori', 'left')
            ->where('muzaki.id_users', session()->get('user_id'))
            ->orderBy('zakat.id', 'desc')
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function storeAddPengajuan()
    {
        $data['biodata'] = $this->biodata->where('id_users', session('user_id'))->first();
        $data['kategori'] = $this->bantuan->findAll();
        $data['pengajuan'] = $this->pengajuan->select('zakat.*, kategori_zis.nama_kategori')
            ->join('mustahik', 'mustahik.id=zakat.id_mustahik', 'left')
            ->join('kategori_zis', 'kategori_zis.id=zakat.id_kategori', 'left')
            ->where('id_users', session()->get('id_user'))
            ->orderBy('zakat.id', 'desc')
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
                'no_bayar' => $param->no_bayar,
                'jumlah_bayar' => $param->jumlah_bayar,
                'tanggal_bayar' => date("Y-m-d H:i:s"),
                'bukti_bayar' => $this->lib->decodebase64($param->berkas->base64),
                'status_transaksi' => "pending",
                'id_muzaki' => $param->id_muzaki,
                'id_mustahik' => $param->id_mustahik,
                'id_kategori' => $param->id_kategori,
            ];
            $this->pengajuan->insert($daftar);
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

    public function edit()
    {
        $param = $this->request->getJSON();
        $conn = \Config\Database::connect();
        try {
            $conn->transException(true)->transStart();
            $param->status_transaksi = 'pending';
            $param->pesan = null;
            $param->bukti_bayar = $this->lib->decodebase64($param->berkas->base64, $param->bukti_bayar);
            $this->pengajuan->update($param->id, $param);
            $conn->transComplete();
            return $this->respond($param);
        } catch (\Throwable $th) {
            $conn->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
