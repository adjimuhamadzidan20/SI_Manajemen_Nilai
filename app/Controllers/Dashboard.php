<?php

namespace App\Controllers;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;

class Dashboard extends BaseController
{
    protected $jurusanModel;
    protected $kelasModel;
    protected $mapelModel;
    protected $siswaModel;

    public function __construct() {
        $this->jurusanModel = new DaftarjurusanModel();
        $this->kelasModel = new DaftarkelasModel();
        $this->mapelModel = new DaftarmapelModel();
        $this->siswaModel = new DaftarsiswaModel();
    }

    public function index()
    {
        $data = [
            'linkActive' => 'dashboard',
            'tab_name' => 'Dashboard',
            'jurusan' => $this->jurusanModel->jumlah(),
            'kelas' => $this->kelasModel->jumlah(),
            'mapel' => $this->mapelModel->jumlah(),
            'siswa' => $this->siswaModel->jumlah()
        ];

        echo view('partials/header', $data);
        echo view('dashboard_view', $data);
        echo view('partials/footer');
    }
}
