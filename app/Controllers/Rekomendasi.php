<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rekomendasi extends BaseController
{
    protected $RekomendasiModel;

    public function __construct()
    {
        $this->RekomendasiModel = new App\Models\RekomendasiModel();
    }

    public function index(): string
    {
        return view('/" . strtolower(Rekomendasi) . "');
    }

    public function store()
    {
        return $this->response->setJSON($this->RekomendasiModel->findAll());
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->RekomendasiModel->insert($param);
            $param->id = $this->RekomendasiModel->insertID();
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
            $this->RekomendasiModel->update($param->id, $param);
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
            $this->RekomendasiModel->delete($id);
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
