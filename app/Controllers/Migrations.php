<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Migrations extends BaseController
{
    protected $MigrationsModel;

    public function __construct()
    {
        $this->MigrationsModel = new App\Models\MigrationsModel();
    }

    public function index(): string
    {
        return view('/" . strtolower(Migrations) . "');
    }

    public function store()
    {
        return $this->response->setJSON($this->MigrationsModel->findAll());
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->MigrationsModel->insert($param);
            $param->id = $this->MigrationsModel->insertID();
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
            $this->MigrationsModel->update($param->id, $param);
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
            $this->MigrationsModel->delete($id);
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
