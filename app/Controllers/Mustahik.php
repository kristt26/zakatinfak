<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Mustahik extends BaseController
{
    protected $MustahikModel;

    public function __construct()
    {
        $this->MustahikModel = new App\Models\MustahikModel();
    }

    public function index(): string
    {
        return view('/" . strtolower(Mustahik) . "');
    }

    public function store()
    {
        return $this->response->setJSON($this->MustahikModel->findAll());
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->MustahikModel->insert($param);
            $param->id = $this->MustahikModel->insertID();
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
            $this->MustahikModel->update($param->id, $param);
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
            $this->MustahikModel->delete($id);
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
