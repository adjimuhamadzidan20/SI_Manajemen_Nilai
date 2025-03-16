<?php

namespace App\Controllers;
use App\Models\PeriodeajaranModel;

class Daftarnilai extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'linkActive' => 'daftar_nilai',
            'tab_name' => 'Daftar Nilai' 
        ];

        echo view('partials/header', $data);
        echo view('daftar_nilai_view', $data);
        echo view('partials/footer');
    }
}
