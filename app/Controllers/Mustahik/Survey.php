<?php

namespace App\Controllers\Mustahik;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Survey extends BaseController
{
    protected $SurveyModel;
    protected $pertanyaan;
    protected $kriteria;
    protected $subKriteria;
    protected $rekom;
    protected $pendaftaran;

    public function __construct()
    {
        $this->SurveyModel = new \App\Models\SurveyModel();
        $this->pertanyaan = new \App\Models\PertanyaanModel();
        $this->kriteria = new \App\Models\KriteriaModel();
        $this->subKriteria = new \App\Models\Sub_kriteriaModel();
        $this->rekom = new \App\Models\RekomendasiModel();
        $this->pendaftaran = new \App\Models\PendaftaranModel();
    }

    public function index(): string
    {
        if (session()->get('akses') == 'mustahik')
            return view('mustahik/survey');
        else
            return view('mustahik/petugas_survey');
    }

    public function store($id)
    {
        $data['survey'] = $this->SurveyModel->where('id_pendaftaran', $id)->findAll();
        $data['kriteria'] = $this->kriteria->findAll();
        foreach ($data['kriteria'] as $key1 => $value1) {
            $value1->subKriteria = $this->subKriteria->where('id_kriteria', $value1->id)->findAll();
            foreach ($value1->subKriteria as $key2 => $value2) {
                $value2->pertanyaan = $this->pertanyaan->where('id_sub_kriteria', $value2->id)->findAll();
                foreach ($value2->pertanyaan as &$row) {
                    if ($row->type == "checkbox") {
                        $row->jawaban = []; // default kosong
                    }
                    if (!empty($row->opsi)) {
                        $row->opsi = unserialize($row->opsi);
                        foreach ($data['survey'] as $key => $survey) {
                            if ($row->id == $survey->id_pertanyaan) {
                                if ($row->type == "checkbox") {
                                    $row->jawaban[] = $survey->jawaban; // simpan skor atau id opsi
                                } else $row->jawaban = $survey->jawaban;
                            }
                        }
                        // hasil jadi array di dalam object
                    } else {
                        $row->opsi = [];
                    }
                }
            }
        }

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
        $conn = \Config\Database::connect();
        try {
            $conn->transException(true)->transStart();
            foreach ($param as $key => $value) {
                if (is_null($value->id)) {
                    $item = [
                        "id_pendaftaran" => $value->id_pendaftaran,
                        "id_pertanyaan" => $value->id_pertanyaan,
                        "jawaban" => $value->jawaban,
                    ];
                    $this->SurveyModel->insert($item);
                } else if ($value->isDeleted)
                    $this->SurveyModel->delete($value->id);
                else
                    $this->SurveyModel->update($value->id, $value);
            }
            $a = $this->hitung($param[0]->id_pendaftaran);
            $layak = true;
            
            foreach ($a as $key => $value) {
                $item = [
                    "id_pendaftaran" => $param[0]->id_pendaftaran,
                    "id_kriteria" => $value->id,
                    "rekap" => $value->total,
                ];
                $this->rekom->insert($item);
                if($value->total < $value->bobot){
                     $layak = false;

                } 
            }
            $nilai = $layak ? 'disetujui' : 'ditolak';
            
            $this->pendaftaran->update($param[0]->id_pendaftaran, ['status_pengajuan'=> $nilai]);
            
            $conn->transComplete();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(400);
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

    public function hitung($id)
    {
        $data['survey'] = $this->SurveyModel->where('id_pendaftaran', $id)->findAll();
        $data['kriteria'] = $this->kriteria->findAll();
        foreach ($data['kriteria'] as $key1 => $value1) {
            $value1->total = 0;
            $value1->subKriteria = $this->subKriteria->where('id_kriteria', $value1->id)->findAll();
            foreach ($value1->subKriteria as $key2 => $value2) {
                $value2->pertanyaan = $this->pertanyaan->where('id_sub_kriteria', $value2->id)->findAll();
                foreach ($value2->pertanyaan as &$row) {
                    if ($value2->nama_sub === "Penghasilan") {
                        foreach ($data['survey'] as $key => $survey) {
                            if ($row->id == $survey->id_pertanyaan) {
                                $pertanyaanLower = strtolower($row->pertanyaan);
                                if ($pertanyaanLower == "pendapatan keluarga total per bulan (rp)") {
                                    $penghasilan = floatval($survey->jawaban);
                                } elseif ($pertanyaanLower == "pengeluaran rutin keluarga per bulan (rp)") {
                                    $pengeluaran = floatval($survey->jawaban);
                                } elseif ($pertanyaanLower == "jumlah anggota keluarga") {
                                    $orang = $survey->jawaban;
                                }
                            }
                        }
                    } else {
                        try {
                            if (!empty($row->opsi)) {
                                $row->opsi = unserialize($row->opsi);
                                foreach ($data['survey'] as $key => $survey) {
                                    if ($row->id == $survey->id_pertanyaan) {
                                        // if()
                                        foreach ($row->opsi as $key => $value) {
                                            if ($value['label'] == $survey->jawaban) $value1->total += $value['skor'];
                                        }
                                    }
                                }
                            } else {
                                $row->opsi = [];
                            }
                        } catch (\Throwable $th) {
                            continue;
                        }
                    }
                }
            }
        }
        $nilaiPerOrang = ($penghasilan - $pengeluaran) / $orang;
        if ($nilaiPerOrang < 1051000) {
            $nilaiPertanyaan = 10;
        } elseif ($nilaiPerOrang <= 1500000) {
            $nilaiPertanyaan = 5;
        } else {
            $nilaiPertanyaan = 0;
        }
        $data['kriteria'][0]->total += $nilaiPertanyaan;

        return $data['kriteria'];
    }
}
