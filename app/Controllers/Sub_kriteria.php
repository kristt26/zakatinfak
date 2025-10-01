<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Sub_kriteria extends BaseController
{
    protected $Sub_kriteriaModel;

    public function __construct()
    {
        $this->Sub_kriteriaModel = new \App\Models\Sub_kriteriaModel();
    }

    public function index($id): string
    {
        return view('admin/subkriteria');
    }

    public function store($id)
    {
        return $this->response->setJSON($this->Sub_kriteriaModel->select('sub_kriteria.*, kriteria.nama_kriteria')->join('kriteria', 'kriteria.id=sub_kriteria.id_kriteria', 'left')->where('id_kriteria', $id)->findAll());
    }

    public function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->Sub_kriteriaModel->insert($param);
            $param->id = $this->Sub_kriteriaModel->insertID();
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
            $this->Sub_kriteriaModel->update($param->id, $param);
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
            $this->Sub_kriteriaModel->delete($id);
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
