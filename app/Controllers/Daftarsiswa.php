<?php

namespace App\Controllers;
use App\Models\DaftarsiswaModel;
use App\Models\PeriodeajaranModel;
use App\Models\DaftarkelasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Mpdf\Mpdf;

class Daftarsiswa extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();
        $kelasModel = new DaftarkelasModel();

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'kelas' => $kelasModel->dataKelasAll(),
            'linkActive' => 'daftar_siswa' 
        ];

        echo view('partials/header');
        echo view('daftar_murid_view', $data);
        echo view('partials/footer');
    }

    public function rinci_kelas($thn_ajaran) {
        $kelasModel = new DaftarkelasModel();
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'kelas' => $kelasModel->dataKelas($thn_ajaran),
            'jumlah' => $kelasModel->jumlahData($thn_ajaran),
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'linkActive' => 'daftar_siswa'
        ];

        echo view('partials/header');
        echo view('daftar_murid_rinci_view', $data);
        echo view('partials/footer');
    }

    public function rinci_siswa($thn_ajaran, $kelas, $jurusan) {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();

        $dataKode = $siswaModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'siswa' => $siswaModel->dataSiswa($thn_ajaran, $kelas, $jurusan),
            'jumlah' => $siswaModel->jumlahData($thn_ajaran, $kelas, $jurusan),
            'kelas' => $kelasModel->detailKelas($thn_ajaran, $kelas, $jurusan),
            'kode' => 'PD'. sprintf('%03s', $kdSekarang),
            'linkActive' => 'daftar_siswa'
        ];

        echo view('partials/header');
        echo view('daftar_murid_isi_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $siswaModel = new DaftarsiswaModel();

        $kode = $this->request->getPost('kd_siswa');
        $nis = $this->request->getPost('nis');
        $nisn = $this->request->getPost('nisn');
        $namaMurid = $this->request->getPost('nama_murid');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('tahun');
        $return = $siswaModel->tambahDataSiswa($kode, $nis, $nisn, $namaMurid, $kelas, $jurusan, $tahunAjaran);

        if ($return) {
            $pesan = 'Peserta didik berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Peserta didik sudah ada!';
            session()->setFlashData('info', $pesan);
        }

        return redirect()->to('/daftar_siswa/rinci_siswa/'.$tahunAjaran.'/'.$kelas.'/'.$jurusan);
    }

    public function ubah() {
        $siswaModel = new DaftarsiswaModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_siswa');
        $nis = $this->request->getPost('nis');
        $nisn = $this->request->getPost('nisn');
        $namaMurid = $this->request->getPost('nama_murid');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('tahun');
        $return = $siswaModel->ubahDataSiswa($id, $kode, $nis, $nisn, $namaMurid, $kelas, $jurusan, $tahunAjaran);

        if ($return) {
            $pesan = 'Peserta didik berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Peserta didik gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_siswa/rinci_siswa/'.$tahunAjaran.'/'.$kelas.'/'.$jurusan);
    }

    public function hapus($id) {
        $siswaModel = new DaftarsiswaModel();
        $return = $siswaModel->hapusDataSiswa($id);

        if ($return) {
            $pesan = 'Peserta didik berhasil terhapus!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Peserta didik gagal terhapus!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_siswa');
    }

    public function cetakPDF($idPeriode, $idKelas, $idJurusan) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");
        $tglFoot = strftime("%d %B %Y");

        $siswaModel = new DaftarsiswaModel();
        $dataSiswa = $siswaModel->dataSiswa($idPeriode, $idKelas, $idJurusan);

         // Create an instance of the class:
        $mpdf = new Mpdf();

        $header = '<div style="border-bottom: 1px solid black; padding-bottom: 5px;">
                    <img src="assets/assets/img/smk_angkasa_1.png" style="width: 80px; float: left; margin-right: 12px;">
                    <h1 style="font-size: 24px; float: left; padding-top: 22px;">SI Manajemen Nilai</h1>      
                </div>';

        foreach ($dataSiswa as $data) :
            $text = '<p><b>Kelas '. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['tahun_ajaran'] .'</b></p>';
        endforeach;

        $waktu = '<p>'. $tglHead .'</p>';

        $table = '<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center; font-size: 13px;">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama Peserta Didik</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                        </tr>';

                        $no = 0;
                        foreach ($dataSiswa as $data) :
                        $no++;
                        $table .= ' <tr>
                                        <td>'. $no .'</td>
                                        <td>'. $data['kd_siswa'] .'</td>
                                        <td>'. $data['nis'] .'</td>
                                        <td>'. $data['nisn'] .'</td>
                                        <td>'. $data['nama_siswa'] .'</td>
                                        <td>'. $data['kelas'] .' '. $data['nama_jurusan'] .'</td>
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

        foreach ($dataSiswa as $data) :
            $fileName = 'Daftar Peserta Didik '.$data['kelas'].' '.$data['nama_jurusan'].' '.$data['tahun_ajaran'].'.pdf';
        endforeach;

        // Output a PDF file directly to the browser
        $mpdf->Output($fileName, \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function cetakExcel($idPeriode, $idKelas, $idJurusan) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");

        $spreadsheet = new Spreadsheet();
        $siswaModel = new DaftarsiswaModel();

        $dataSiswa = $siswaModel->dataSiswa($idPeriode, $idKelas, $idJurusan);
        $sheetBaris = $spreadsheet->getActiveSheet();

        $header = 'SI Manajemen Nilai';
        foreach ($dataSiswa as $data) :
            $text = 'Kelas '. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['tahun_ajaran'];
        endforeach;
        $waktu = $tglHead;

        $sheetBaris->setCellValue('A1', $header);
        $sheetBaris->setCellValue('A2', $text);
        $sheetBaris->setCellValue('A3', $waktu);

        $sheetBaris->setCellValue('A5', 'No');
        $sheetBaris->setCellValue('B5', 'Kode');
        $sheetBaris->setCellValue('C5', 'NIS');
        $sheetBaris->setCellValue('D5', 'NISN');
        $sheetBaris->setCellValue('E5', 'Nama Peserta Didik');
        $sheetBaris->setCellValue('F5', 'Kelas');
        $sheetBaris->setCellValue('G5', 'Tahun Ajaran');

        $baris = 6;
        $no = 1;
        foreach ($dataSiswa as $data) :
            $sheetBaris->setCellValue('A' . $baris, $no++);
            $sheetBaris->setCellValue('B' . $baris, $data['kd_siswa']);
            $sheetBaris->setCellValue('C' . $baris, $data['nis']);
            $sheetBaris->setCellValue('D' . $baris, $data['nisn']);
            $sheetBaris->setCellValue('E' . $baris, $data['nama_siswa']);
            $sheetBaris->setCellValue('F' . $baris, $data['kelas'] .' '. $data['nama_jurusan']);
            $sheetBaris->setCellValue('G' . $baris, $data['tahun_ajaran']);
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
        foreach ($dataSiswa as $data) :
            $fileName = 'Daftar Peserta Didik '.$data['kelas'].' '.$data['nama_jurusan'].' '.$data['tahun_ajaran'].'.xlsx';
        endforeach;

        $writer = new Xlsx($spreadsheet);

        // Set header agar browser mengenali file sebagai Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
