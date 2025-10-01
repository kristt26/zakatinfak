<?php

namespace App\Controllers\Muzaki;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Biodata extends BaseController
{
    protected $biodata;

    public function __construct()
    {
        $this->biodata = new \App\Models\MuzakiModel();
    }

    public function index(): string
    {
        return view('muzaki/biodata');
    }

    public function store()
    {
        return $this->response->setJSON($this->biodata->where('id_users', session()->get('user_id'))->first());
    }

    public function edit(): ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->biodata->update($param->id, $param);
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
}
