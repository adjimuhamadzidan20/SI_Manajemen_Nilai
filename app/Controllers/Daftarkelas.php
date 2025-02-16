<?php

namespace App\Controllers;
use App\Models\DaftarkelasModel;
use App\Models\DaftarjurusanModel;
use App\Models\PeriodeajaranModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Mpdf\Mpdf;

class Daftarkelas extends BaseController
{   
    public function index()
    {   
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'linkActive' => 'daftar_kelas' 
        ];

        echo view('partials/header');   
        echo view('daftar_kelas_view', $data);
        echo view('partials/footer');
    }

    public function periode($thn_ajaran) {
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $periodeModel = new PeriodeajaranModel();

        $dataKode = $kelasModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'kelas' => $kelasModel->dataKelas($thn_ajaran),
            'jurusan' => $jurusanModel->dataJurusan(),
            'kode' => 'KE'. sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(), 
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'id_periode' => $periodeModel->idPeriode($thn_ajaran),
            'linkActive' => 'daftar_kelas'
        ];

        echo view('partials/header');   
        echo view('daftar_kelas_isi_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $kelasModel = new DaftarkelasModel();

        $kode = $this->request->getPost('kd_kelas');
        $keahlian = $this->request->getPost('keahlian');
        $kelas = $this->request->getPost('kelas');
        $periode = $this->request->getPost('tahun');
        $return = $kelasModel->tambahDataKelas($kode, $keahlian, $kelas, $periode);

        if ($return) {
            $pesan = 'Data kelas berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Data kelas gagal ditambahkan!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_kelas/periode_kelas/'. $periode);
    }

    public function ubah() {
        $kelasModel = new DaftarkelasModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_kelas');
        $keahlian = $this->request->getPost('keahlian');
        $kelas = $this->request->getPost('kelas');
        $periode = $this->request->getPost('tahun');
        $return = $kelasModel->ubahDataKelas($id, $kode, $keahlian, $kelas, $periode);

        if ($return) {
            $pesan = 'Data kelas berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Data kelas gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_kelas/periode_kelas/'. $periode);
    }

    public function hapus($id) {
        $kelasModel = new DaftarkelasModel();
        $return = $kelasModel->hapusDataKelas($id);

        if ($return) {
            $pesan = 'Data kelas berhasil terhapus!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Data kelas gagal terhapus!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_kelas');
    }

    public function cetakPDF($idPeriode) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");
        $tglFoot = strftime("%d %B %Y");

        $kelasModel = new DaftarkelasModel();
        $periodeModel = new PeriodeajaranModel();

        $dataKelas = $kelasModel->cetakDataKelas($idPeriode);
        $tahunAjaran = $periodeModel->tahunPeriode($idPeriode);

         // Create an instance of the class:
        $mpdf = new Mpdf();

        $header = '<div style="border-bottom: 1px solid black; padding-bottom: 5px;">
                    <h1 style="font-size: 24px;">SI Manajemen Nilai</h1>      
                </div>';

        $text = '<p><b>Daftar Kelas '. $tahunAjaran .'</b></p>';
        $waktu = '<p>'. $tglHead .'</p>';

        $table = '<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center; font-size: 13px;">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Program Keahlian</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                        </tr>';

                        $no = 0;
                        foreach ($dataKelas as $data) :
                        $no++;
                        $table .= ' <tr>
                                        <td>'. $no .'</td>
                                        <td>'. $data['kd_kelas'] .'</td>
                                        <td>'. $data['nama_jurusan'] .'</td>
                                        <td>'. $data['kelas'] .'</td>
                                        <td>'. $data['tahun_ajaran'] .'</td>
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
        $mpdf->Output('Daftar Kelas '. $tahunAjaran .'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function cetakExcel($idPeriode) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");

        $spreadsheet = new Spreadsheet();
        $kelasModel = new DaftarkelasModel();
        $periodeModel = new PeriodeajaranModel();

        $dataKelas = $kelasModel->cetakDataKelas($idPeriode);
        $tahunAjaran = $periodeModel->tahunPeriode($idPeriode);
        $sheetBaris = $spreadsheet->getActiveSheet();

        $header = 'SI Manajemen Nilai';
        $text = 'Daftar Kelas '. $tahunAjaran;
        $waktu = $tglHead;

        $sheetBaris->setCellValue('A1', $header);
        $sheetBaris->setCellValue('A2', $text);
        $sheetBaris->setCellValue('A3', $waktu);

        $sheetBaris->setCellValue('A5', 'No');
        $sheetBaris->setCellValue('B5', 'Kode');
        $sheetBaris->setCellValue('C5', 'Program Keahlian');
        $sheetBaris->setCellValue('D5', 'Kelas');
        $sheetBaris->setCellValue('E5', 'Tahun Ajaran');

        $baris = 6;
        $no = 1;
        foreach ($dataKelas as $data) :
            $sheetBaris->setCellValue('A' . $baris, $no++);
            $sheetBaris->setCellValue('B' . $baris, $data['kd_kelas']);
            $sheetBaris->setCellValue('C' . $baris, $data['nama_jurusan']);
            $sheetBaris->setCellValue('D' . $baris, $data['kelas']);
            $sheetBaris->setCellValue('E' . $baris, $data['tahun_ajaran']);
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

        $sheetBaris->getStyle('A5:E5')->applyFromArray([
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
        $sheetBaris->getStyle('A5:E'. $lastRow)->applyFromArray([
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
        foreach (range('B', 'E') as $col) {
            $sheetBaris->getColumnDimension($col)->setAutoSize(true);
        }

        // Set nama file
        $fileName = 'Daftar Kelas '. $tahunAjaran .'.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Set header agar browser mengenali file sebagai Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
