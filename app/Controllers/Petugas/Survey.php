<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Survey extends BaseController
{
    protected $SurveyModel;
    protected $pertanyaan;
    protected $kriteria;
    protected $subKriteria;

    public function __construct()
    {
        $this->SurveyModel = new \App\Models\SurveyModel();
        $this->pertanyaan = new \App\Models\PertanyaanModel();
        $this->kriteria = new \App\Models\KriteriaModel();
        $this->subKriteria = new \App\Models\Sub_kriteriaModel();
    }

    public function index(): string
    {
        return view('petugas/daftar');
    }

    public function store($id)
    {
        $data['kriteria'] = $this->kriteria->findAll();
        foreach ($data['kriteria'] as $key1 => $value1) {
            $value1->subKriteria = $this->subKriteria->where('id_kriteria', $value1->id)->findAll();
            foreach ($value1->subKriteria as $key2 => $value2) {
                $value2->pertanyaan = $this->pertanyaan->where('id_sub_kriteria', $value2->id)->findAll();
                foreach ($value2->pertanyaan as &$row) {
                    if (!empty($row->opsi)) {
                        $row->opsi = unserialize($row->opsi); // hasil jadi array di dalam object
                    } else {
                        $row->opsi = [];
                    }
                }
            }
        }
        $data['survey'] = $this->SurveyModel->where('id_pendaftaran', $id)->findAll();
        return $this->response->setJSON($data);
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->SurveyModel->insertBatch($param);
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
