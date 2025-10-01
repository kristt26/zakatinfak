<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Persyaratan extends BaseController
{
    protected $PersyaratanModel;

    public function __construct()
    {
        $this->PersyaratanModel = new \App\Models\PersyaratanModel();
    }

    public function index($id): string
    {
        return view('admin/persyaratan');
    }

    public function store($id)
    {
        $data = $this->PersyaratanModel->select("persyaratan.*, jenis_bantuan.nama_bantuan")->join('jenis_bantuan', 'jenis_bantuan.id=persyaratan.id_jenis_bantuan', 'left')->where('id_jenis_bantuan', $id)->findAll();
        return $this->response->setJSON($data);
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->PersyaratanModel->insert($param);
            $param->id = $this->PersyaratanModel->insertID();
            $model = new \App\Models\Jenis_bantuanModel();
            $param->nama_bantuan = $model->where('id', $param->id_jenis_bantuan)->first()->nama_bantuan;
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
            $this->PersyaratanModel->update($param->id, $param);
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
            $this->PersyaratanModel->delete($id);
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
