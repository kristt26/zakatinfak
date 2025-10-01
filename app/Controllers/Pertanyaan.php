<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pertanyaan extends BaseController
{
    protected $PertanyaanModel;

    public function __construct()
    {
        $this->PertanyaanModel = new \App\Models\PertanyaanModel();
    }

    public function index($id): string
    {
        return view('admin/pertanyaan');
    }

    public function store($id)
    {
        $data = $this->PertanyaanModel->select('pertanyaan.*, sub_kriteria.nama_sub')->join('sub_kriteria', 'sub_kriteria.id=pertanyaan.id_sub_kriteria', 'left')->where('id_sub_kriteria', $id)->findAll();

        foreach ($data as &$row) {
            if (!empty($row->opsi)) {
                $row->opsi = unserialize($row->opsi); // hasil jadi array di dalam object
            } else {
                $row->opsi = [];
            }
        }

        return $this->response->setJSON($data);
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->PertanyaanModel->insert($param);
            $param->id = $this->PertanyaanModel->insertID();
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
            $this->PertanyaanModel->update($param->id, $param);
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
            $this->PertanyaanModel->delete($id);
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
