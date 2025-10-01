<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Survey extends BaseController
{
    protected $SurveyModel;
    protected $pertanyaan;

    public function __construct()
    {
        $this->SurveyModel = new \App\Models\SurveyModel();
        $this->pertanyaan = new \App\Models\PertanyaanModel();
    }

    public function index(): string
    {
        return view('mustahik/survey');
    }

    public function store()
    {
        $data = $this->pertanyaan->select('pertanyaan.*, sub_kriteria.nama_sub')->join('sub_kriteria', 'sub_kriteria.id=pertanyaan.id_sub_kriteria', 'left')->findAll();

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
            $this->SurveyModel->insert($param);
            $param->id = $this->SurveyModel->insertID();
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
            $this->SurveyModel->update($param->id, $param);
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
            $this->SurveyModel->delete($id);
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
