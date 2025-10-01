<?php

namespace App\Controllers;

use App\Models\Jenis_bantuanModel;
use App\Models\Kategori_zisModel;
use App\Models\PersyaratanModel;

class Home extends BaseController
{
    public function index(): string
    {
        $bantuan = new Jenis_bantuanModel();
        $syarat = new PersyaratanModel();
        $kategori = new Kategori_zisModel();

        $data['bantuan'] = $bantuan->findAll();
        foreach ($data['bantuan'] as $key => $value) {
            $value->persyaratan = $syarat->where('id_jenis_bantuan', $value->id)->findAll();
        }
        $data['kategori'] = $kategori->findAll();
        return view('home', $data);
    }
}
