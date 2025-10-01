<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kelengkapan extends BaseController
{
    protected $KelengkapanModel;

    public function __construct()
    {
        $this->KelengkapanModel = new App\Models\KelengkapanModel();
    }

    public function index(): string
    {
        return view('/" . strtolower(Kelengkapan) . "');
    }

    public function store()
    {
        return $this->response->setJSON($this->KelengkapanModel->findAll());
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->KelengkapanModel->insert($param);
            $param->id = $this->KelengkapanModel->insertID();
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
            $this->KelengkapanModel->update($param->id, $param);
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
            $this->KelengkapanModel->delete($id);
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
