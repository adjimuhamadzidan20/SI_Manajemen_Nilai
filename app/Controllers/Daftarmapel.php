<?php

namespace App\Controllers;
use App\Models\DaftarmapelModel;
use App\Models\DaftarjurusanModel;
use App\Models\PeriodeajaranModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Mpdf\Mpdf;

class Daftarmapel extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'linkActive' => 'daftar_mapel'  
        ];
        
        echo view('partials/header');
        echo view('daftar_mapel_view', $data);
        echo view('partials/footer');
    }

    public function periode($thn_ajaran) {
        $jurusanModel = new DaftarjurusanModel();
        $periodeModel = new PeriodeajaranModel();
        $mapelModel = new DaftarmapelModel();

        $dataKode = $mapelModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'mapel' => $mapelModel->dataMapel($thn_ajaran),
            'jumlah' => $mapelModel->jumlahData($thn_ajaran),
            'jurusan' => $jurusanModel->dataJurusan(),
            'kode' => 'MA'. sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(), 
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'id_periode' => $periodeModel->idPeriode($thn_ajaran),
            'linkActive' => 'daftar_mapel'
        ];

        echo view('partials/header');   
        echo view('daftar_mapel_isi_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $mapelModel = new DaftarmapelModel();

        $kode = $this->request->getPost('kd_mapel');
        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('periode');
        $guru = $this->request->getPost('guru');
        $return = $mapelModel->tambahDataMapel($kode, $mapel, $kelas, $jurusan, $tahunAjaran, $guru);

        if ($return) {
            $pesan = 'Mata pelajaran berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Mata pelajaran dan kelas sudah ada!';
            session()->setFlashData('info', $pesan);
        }

        return redirect()->to('/daftar_mapel/periode_mapel/'. $tahunAjaran);
    }

    public function ubah() {
        $mapelModel = new DaftarmapelModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_mapel');
        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('periode');
        $guru = $this->request->getPost('guru');
        $return = $mapelModel->ubahDataMapel($id, $kode, $mapel, $kelas, $jurusan, $tahunAjaran, $guru);

        if ($return) {
            $pesan = 'Mata pelajaran berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Mata pelajaran gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_mapel/periode_mapel/'. $tahunAjaran);
    }

    public function hapus($id) {
        $mapelModel = new DaftarmapelModel();
        $return = $mapelModel->hapusDataMapel($id);

        if ($return) {
            $pesan = 'Mata pelajaran berhasil terhapus!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Mata pelajaran gagal terhapus!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_mapel');
    }

    public function cetakPDF($idPeriode) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");
        $tglFoot = strftime("%d %B %Y");

        $mapelModel = new DaftarmapelModel();
        $periodeModel = new PeriodeajaranModel();

        $dataMapel = $mapelModel->dataMapel($idPeriode);
        $tahunAjaran = $periodeModel->tahunPeriode($idPeriode);

         // Create an instance of the class:
        $mpdf = new Mpdf();

        $header = '<div style="border-bottom: 1px solid black; padding-bottom: 5px;">
                    <img src="assets/assets/img/smk_angkasa_1.png" style="width: 80px; float: left; margin-right: 12px;">
                    <h1 style="font-size: 24px; float: left; padding-top: 22px;">SI Manajemen Nilai</h1>      
                </div>';

        $text = '<p><b>Daftar Mata Pelajaran '. $tahunAjaran .'</b></p>';
        $waktu = '<p>'. $tglHead .'</p>';

        $table = '<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center; font-size: 13px;">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Mapel</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Tahun Ajaran</th>
                            <th>Guru Mapel</th>
                        </tr>';

                        $no = 0;
                        foreach ($dataMapel as $data) :
                        $no++;
                        $table .= ' <tr>
                                        <td>'. $no .'</td>
                                        <td>'. $data['kd_mapel'] .'</td>
                                        <td>'. $data['nama_mapel'] .'</td>
                                        <td>'. $data['kelas'] .'</td>
                                        <td>'. $data['nama_jurusan'] .'</td>
                                        <td>'. $data['tahun_ajaran'] .'</td>
                                        <td>'. $data['guru'] .'</td>
                                    </tr>';
                        endforeach;

                    $table .= ' 
                    </table>';

        $date = '<div style="text-align: right; margin-top:50px;">
                    <p>Jakarta, '. $tglFoot .'</p>
                    <br><br>
                    <p>Admin</p>
                 </div>';

        // $mpdf->SetFooter('Document Title');
        $mpdf->WriteHTML($header);
        $mpdf->WriteHTML($text);
        $mpdf->WriteHTML($waktu);
        $mpdf->WriteHTML($table);
        $mpdf->WriteHTML($date);
        $mpdf->setFooter('SI Manajemen Nilai || {PAGENO}');

        // Output a PDF file directly to the browser
        $mpdf->Output('Daftar Mata Pelajaran '. $tahunAjaran .'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function cetakExcel($idPeriode) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");

        $spreadsheet = new Spreadsheet();
        $mapelModel = new DaftarmapelModel();
        $periodeModel = new PeriodeajaranModel();

        $dataMapel = $mapelModel->dataMapel($idPeriode);
        $tahunAjaran = $periodeModel->tahunPeriode($idPeriode);
        $sheetBaris = $spreadsheet->getActiveSheet();

        $header = 'SI Manajemen Nilai';
        $text = 'Daftar Mata Pelajaran '. $tahunAjaran;
        $waktu = $tglHead;

        $sheetBaris->setCellValue('A1', $header);
        $sheetBaris->setCellValue('A2', $text);
        $sheetBaris->setCellValue('A3', $waktu);

        $sheetBaris->setCellValue('A5', 'No');
        $sheetBaris->setCellValue('B5', 'Kode');
        $sheetBaris->setCellValue('C5', 'Nama Mapel');
        $sheetBaris->setCellValue('D5', 'Kelas');
        $sheetBaris->setCellValue('E5', 'Jurusan');
        $sheetBaris->setCellValue('F5', 'Tahun Ajaran');
        $sheetBaris->setCellValue('G5', 'Guru Mapel');

        $baris = 6;
        $no = 1;
        foreach ($dataMapel as $data) :
            $sheetBaris->setCellValue('A' . $baris, $no++);
            $sheetBaris->setCellValue('B' . $baris, $data['kd_mapel']);
            $sheetBaris->setCellValue('C' . $baris, $data['nama_mapel']);
            $sheetBaris->setCellValue('D' . $baris, $data['kelas']);
            $sheetBaris->setCellValue('E' . $baris, $data['nama_jurusan']);
            $sheetBaris->setCellValue('F' . $baris, $data['tahun_ajaran']);
            $sheetBaris->setCellValue('G' . $baris, $data['guru']);
            $baris++;
        endforeach;

        $sheetBaris->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 15,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheetBaris->getStyle('A5:G5')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

         // Menentukan batas akhir data
        $lastRow = $baris - 1;

        // Tambahkan border ke seluruh tabel
        $sheetBaris->getStyle('A5:G'. $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Mengatur ukuran kolom agar otomatis menyesuaikan isi
        foreach (range('B', 'G') as $col) {
            $sheetBaris->getColumnDimension($col)->setAutoSize(true);
        }

        // Set nama file
        $fileName = 'Daftar Mata Pelajaran '. $tahunAjaran .'.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Set header agar browser mengenali file sebagai Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
