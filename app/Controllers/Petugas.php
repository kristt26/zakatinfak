<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Petugas extends BaseController
{
    protected $PetugasModel;
    protected $User;

    public function __construct()
    {
        $this->PetugasModel = new \App\Models\PetugasModel();
        $this->User = new \App\Models\UsersModel();
    }

    public function index(): string
    {
        return view('admin/petugas');
    }

    public function store()
    {
        return $this->response->setJSON($this->PetugasModel->select("petugas.*, users.username, users.akses")->join('users', 'users.id=petugas.id_users', 'left')->findAll());
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        $conn = \Config\Database::connect();
        try {
            $conn->transException(true)->transStart();
            $user = ['username' => $param->username, 'password' => password_hash($param->password, PASSWORD_DEFAULT), 'akses' => $param->akses];
            $param->id_users = $this->User->insert($user, true);
            $this->PetugasModel->insert($param);
            $param->id = $this->PetugasModel->insertID();
            $conn->transComplete();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            $conn->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function edit(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->PetugasModel->update($param->id, $param);
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
            $this->PetugasModel->delete($id);
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
