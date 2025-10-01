<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    protected $UsersModel;

    public function __construct()
    {
        $this->UsersModel = new App\Models\UsersModel();
    }

    public function index(): string
    {
        return view('/" . strtolower(Users) . "');
    }

    public function store()
    {
        return $this->response->setJSON($this->UsersModel->findAll());
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->UsersModel->insert($param);
            $param->id = $this->UsersModel->insertID();
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
            $this->UsersModel->update($param->id, $param);
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
            $this->UsersModel->delete($id);
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
