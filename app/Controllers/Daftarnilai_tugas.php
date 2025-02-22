<?php

namespace App\Controllers;
use App\Models\PeriodeajaranModel;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;
use App\Models\DaftarnilaitugasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Mpdf\Mpdf;

class Daftarnilai_tugas extends BaseController
{
    public function nilai_tugas_periode($thn_ajaran) {
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $periodeModel = new PeriodeajaranModel();
        $mapelModel = new DaftarmapelModel();

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
            'mapel' => $mapelModel->dataMapel($thn_ajaran),
            'linkActive' => 'daftar_nilai' 
        ];

        echo view('partials/header');   
        echo view('daftar_nilaitugas_view', $data);
        echo view('partials/footer');
    }
    
    public function tambah() {
        $nilaiTugasModel = new DaftarnilaitugasModel();

        $namaMapel = $this->request->getPost('nama_mapel');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $idMapel = $this->request->getPost('id_mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilai_1 = $this->request->getPost('tp_1');
        $nilai_2 = $this->request->getPost('tp_2');
        $nilai_3 = $this->request->getPost('tp_3');
        $nilai_4 = $this->request->getPost('tp_4');
        $nilai_5 = $this->request->getPost('tp_5');
        $nilai_6 = $this->request->getPost('tp_6');
        $nilai_7 = $this->request->getPost('tp_7');
        $nilai_8 = $this->request->getPost('tp_8');
        $nilai_9 = $this->request->getPost('tp_9');

        $return = $nilaiTugasModel->tambahDataNilaiTugas($pesertaDidik, $idMapel, $kelas, $jurusan, $periodeAjaran, 
        $semester, $nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9);

        if ($return) {
            $pesan = 'Nilai tugas berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Nilai tugas gagal ditambahkan!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_nilai_tugas/peserta_didik/'.$kelas.'/'.$jurusan.'/'.$namaMapel.'/'.$idMapel.'/'.
        $periodeAjaran.'/'.$semester);
    }

     public function ubah() {
        $nilaiTugasModel = new DaftarnilaitugasModel();

        $namaMapel = $this->request->getPost('nama_mapel');
        $id = $this->request->getPost('id');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $idMapel = $this->request->getPost('id_mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilai_1 = $this->request->getPost('tp_1');
        $nilai_2 = $this->request->getPost('tp_2');
        $nilai_3 = $this->request->getPost('tp_3');
        $nilai_4 = $this->request->getPost('tp_4');
        $nilai_5 = $this->request->getPost('tp_5');
        $nilai_6 = $this->request->getPost('tp_6');
        $nilai_7 = $this->request->getPost('tp_7');
        $nilai_8 = $this->request->getPost('tp_8');
        $nilai_9 = $this->request->getPost('tp_9');

        $return = $nilaiTugasModel->ubahDataNilaiTugas($id, $pesertaDidik, $idMapel, $kelas, $jurusan, $periodeAjaran, 
        $semester, $nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9);

        if ($return) {
            $pesan = 'Nilai tugas berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Nilai tugas gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_nilai_tugas/peserta_didik/'.$kelas.'/'.$jurusan.'/'.$namaMapel.'/'.$idMapel.'/'.
        $periodeAjaran.'/'.$semester);
    }

    public function peserta_didik($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $mapelModel = new DaftarmapelModel();
        $nilaiTugasModel = new DaftarnilaitugasModel();
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'siswa' => $siswaModel->pesertaDidik($kelas, $jurusan),
            'siswa_jumlah' => $siswaModel->jumlahPesertaDidik($kelas, $jurusan),

            // 'id_kelas' => $kelasModel->idKelas($kelas),
            'kelas' => $kelasModel->kelas($kelas),

            'id_jurusan' => $jurusanModel->idJurusan($jurusan),
            'nama_jurusan' => $jurusanModel->jurusan($jurusan),

            'id_mapel' => $mapelModel->dataMapelDetailID($idMapel),
            'nama_mapel' => $mapelModel->dataMapelDetail($namaMapel),
            
            'tahun_ajaran' => $periodeModel->tahunPeriode($idPeriode),
            'id_periode' => $periodeModel->idPeriode($idPeriode),

            'semester' => $semester,
            'nilai' => $nilaiTugasModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel), 
            'jumlah' => $nilaiTugasModel->jumlahData($semester, $idPeriode, $kelas, $jurusan, $idMapel), 
            'linkActive' => 'daftar_nilai'
        ];

        echo view('partials/header');
        echo view('nilaitugas_siswa', $data);
        echo view('partials/footer');
    }

    public function cetakPDF($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");
        $tglFoot = strftime("%d %B %Y");

        $nilaiTugasModel = new DaftarnilaitugasModel();
        $dataNilaiTugas = $nilaiTugasModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel);

         // Create an instance of the class:
        $mpdf = new Mpdf();

        $header = '<div style="border-bottom: 1px solid black; padding-bottom: 5px;">
                    <h1 style="font-size: 24px;">SI Manajemen Nilai</h1>      
                </div>';

        foreach ($dataNilaiTugas as $data) :
            $text = '<p><b>'. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'] .
            '</b></p>';
        endforeach;

        $waktu = '<p>'. $tglHead .'</p>';

        $table = '<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center; font-size: 10px;">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">NIS</th>
                            <th rowspan="2">NISN</th>
                            <th rowspan="2">Nama Peserta Didik</th>
                            
                            <th colspan="3">Lingkup Materi 1</th>
                            <th colspan="3">Lingkup Materi 2</th>
                            <th colspan="3">Lingkup Materi 3</th>
                           
                            <th rowspan="2">NA<br>(M)</th>
                            <th rowspan="2">LM1</th>
                            <th rowspan="2">LM2</th>
                            <th rowspan="2">LM3</th>
                            <th rowspan="2">NA<br>(S)</th>
                        </tr>
                        <tr>
                            <th>TP1</th>
                            <th>TP2</th>
                            <th>TP3</th>
                            <th>TP1</th>
                            <th>TP2</th>
                            <th>TP3</th>
                            <th>TP1</th>
                            <th>TP2</th>
                            <th>TP3</th>
                        </tr>';

                        $no = 0;
                        foreach ($dataNilaiTugas as $data) :
                        $no++;
                        $table .= ' <tr>
                                        <td>'. $no .'</td>
                                        <td>'. $data['nis'] .'</td>
                                        <td>'. $data['nisn'] .'</td>
                                        <td style="text-align: left;">'. $data['nama_siswa'] .'</td>
                                        <td>'. $data['nilai_1'] .'</td>
                                        <td>'. $data['nilai_2'] .'</td>
                                        <td>'. $data['nilai_3'] .'</td>
                                        <td>'. $data['nilai_4'] .'</td>
                                        <td>'. $data['nilai_5'] .'</td>
                                        <td>'. $data['nilai_6'] .'</td>
                                        <td>'. $data['nilai_7'] .'</td>
                                        <td>'. $data['nilai_8'] .'</td>
                                        <td>'. $data['nilai_9'] .'</td>
                                        <td>'. $data['na_materi'] .'</td>
                                        <td>'. $data['LM_1'] .'</td>
                                        <td>'. $data['LM_2'] .'</td>
                                        <td>'. $data['LM_3'] .'</td>
                                        <td>'. $data['na_sumatif'] .'</td>
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

        foreach ($dataNilaiTugas as $data) :
            $fileName = 'Nilai Tugas '. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'].'.pdf';
        endforeach;

        // Output a PDF file directly to the browser
        $mpdf->Output($fileName, \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function cetakExcel($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");

        $spreadsheet = new Spreadsheet();
        $nilaiTugasModel = new DaftarnilaitugasModel();

        $dataNilaiTugas = $nilaiTugasModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel);
        $sheetBaris = $spreadsheet->getActiveSheet();

        $header = 'SI Manajemen Nilai';
        foreach ($dataNilaiTugas as $data) :
            $text = $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'];
        endforeach;
        $waktu = $tglHead;

        $sheetBaris->setCellValue('A1', $header);
        $sheetBaris->setCellValue('A2', $text);
        $sheetBaris->setCellValue('A3', $waktu);

        $sheetBaris->mergeCells('A5:A6');
        $sheetBaris->mergeCells('B5:B6');
        $sheetBaris->mergeCells('C5:C6');
        $sheetBaris->mergeCells('D5:D6');

        $sheetBaris->setCellValue('A5', 'No');
        $sheetBaris->setCellValue('B5', 'NIS');
        $sheetBaris->setCellValue('C5', 'NISN');
        $sheetBaris->setCellValue('D5', 'Nama Peserta Didik');

        $sheetBaris->mergeCells('E5:G5');
        $sheetBaris->mergeCells('H5:J5');
        $sheetBaris->mergeCells('K5:M5');

        $sheetBaris->setCellValue('E5', 'Lingkup Materi 1');
        $sheetBaris->setCellValue('H5', 'Lingkup Materi 2');
        $sheetBaris->setCellValue('K5', 'Lingkup Materi 3');

        $sheetBaris->setCellValue('E6', 'TP 1');
        $sheetBaris->setCellValue('F6', 'TP 2');
        $sheetBaris->setCellValue('G6', 'TP 3');

        $sheetBaris->setCellValue('H6', 'TP 1');
        $sheetBaris->setCellValue('I6', 'TP 2');
        $sheetBaris->setCellValue('J6', 'TP 3');

        $sheetBaris->setCellValue('K6', 'TP 1');
        $sheetBaris->setCellValue('L6', 'TP 2');
        $sheetBaris->setCellValue('M6', 'TP 3');

        $sheetBaris->mergeCells('N5:N6');
        $sheetBaris->mergeCells('O5:O6');
        $sheetBaris->mergeCells('P5:P6');
        $sheetBaris->mergeCells('Q5:Q6');
        $sheetBaris->mergeCells('R5:R6');

        $sheetBaris->setCellValue('N5', 'NA Materi');
        $sheetBaris->setCellValue('O5', 'LM 1');
        $sheetBaris->setCellValue('P5', 'LM 2');
        $sheetBaris->setCellValue('Q5', 'LM 3');
        $sheetBaris->setCellValue('R5', 'NA SUMATIF');

        $baris = 7;
        $no = 1;
        foreach ($dataNilaiTugas as $data) :
            $sheetBaris->setCellValue('A' . $baris, $no++);
            $sheetBaris->setCellValue('B' . $baris, $data['nis']);
            $sheetBaris->setCellValue('C' . $baris, $data['nisn']);
            $sheetBaris->setCellValue('D' . $baris, $data['nama_siswa']);
            $sheetBaris->setCellValue('E' . $baris, $data['nilai_1']);
            $sheetBaris->setCellValue('F' . $baris, $data['nilai_2']);
            $sheetBaris->setCellValue('G' . $baris, $data['nilai_3']);
            $sheetBaris->setCellValue('H' . $baris, $data['nilai_4']);
            $sheetBaris->setCellValue('I' . $baris, $data['nilai_5']);
            $sheetBaris->setCellValue('J' . $baris, $data['nilai_6']);
            $sheetBaris->setCellValue('K' . $baris, $data['nilai_7']);
            $sheetBaris->setCellValue('L' . $baris, $data['nilai_8']);
            $sheetBaris->setCellValue('M' . $baris, $data['nilai_9']);
            $sheetBaris->setCellValue('N' . $baris, $data['na_materi']);
            $sheetBaris->setCellValue('O' . $baris, $data['LM_1']);
            $sheetBaris->setCellValue('P' . $baris, $data['LM_2']);
            $sheetBaris->setCellValue('Q' . $baris, $data['LM_3']);
            $sheetBaris->setCellValue('R' . $baris, $data['na_sumatif']);
            $baris++;
        endforeach;

        // Menentukan batas akhir data
        $lastRow = $baris - 1;

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

        $sheetBaris->getStyle('A5:R5')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheetBaris->getStyle('A7:D'. $lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheetBaris->getStyle('E7:R'. $lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheetBaris->getStyle('E6:M6')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Tambahkan border ke seluruh tabel
        $sheetBaris->getStyle('A5:R'. $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Mengatur ukuran kolom agar otomatis menyesuaikan isi
        foreach (range('B', 'R') as $col) {
            $sheetBaris->getColumnDimension($col)->setAutoSize(true);
        }

        // Set nama file
        foreach ($dataNilaiTugas as $data) :
            $fileName = 'Nilai Tugas '. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'].'.xlsx';
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
