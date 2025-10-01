<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Muzaki extends BaseController
{
    protected $MuzakiModel;

    public function __construct()
    {
        $this->MuzakiModel = new \App\Models\UsersModel();
    }

    public function index(): string
    {
        return view('admin/muzaki');
    }

    public function store()
    {
        $muzaki = $this->MuzakiModel->select("muzaki.nama, muzaki.alamat, muzaki.telepon, muzaki.nik, users.username, users.akses")
        ->join('muzaki', 'muzaki.id_users=users.id', 'left')->where('akses', 'muzaki')->findAll();
        $mustahik = $this->MuzakiModel->select("mustahik.nama, mustahik.alamat, mustahik.telepon, mustahik.nik, users.username, users.akses")
        ->join('mustahik', 'mustahik.id_users=users.id', 'left')->where('akses', 'mustahik')->findAll();
        return $this->response->setJSON(array_merge($muzaki,$mustahik));
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->MuzakiModel->insert($param);
            $param->id = $this->MuzakiModel->insertID();
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
            $this->MuzakiModel->update($param->id, $param);
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
            $this->MuzakiModel->delete($id);
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
