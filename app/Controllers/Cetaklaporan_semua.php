<?php

namespace App\Controllers;

use App\Models\PeriodeajaranModel;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;
use App\Models\DaftarnilaisiswaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Mpdf\Mpdf;

class Cetaklaporan_semua extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'linkActive' => 'cetak_laporan',
            'tab_name' => 'Cetak Laporan'  
        ];

        echo view('partials/header', $data);
        echo view('cetak_laporan_view', $data);
        echo view('partials/footer');
    }

    public function nilai_mapel_semua($thn_ajaran)
    {
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
            'kode' => 'KE' . sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(),
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'id_periode' => $periodeModel->idPeriode($thn_ajaran),
            'mapel' => $mapelModel->dataMapel($thn_ajaran),
            'linkActive' => 'cetak_laporan',
            'tab_name' => 'Cetak Laporan' 
        ];

        echo view('partials/header', $data);
        echo view('cetak_nilai_semua_view', $data);
        echo view('partials/footer');
    }

    public function peserta_didik($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester)
    {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $mapelModel = new DaftarmapelModel();
        $nilaiSiswaModel = new DaftarnilaisiswaModel();
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
            'nilai' => $nilaiSiswaModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel),
            'jumlah' => $nilaiSiswaModel->jumlahData($semester, $idPeriode, $kelas, $jurusan, $idMapel),
            'linkActive' => 'cetak_laporan',
            'tab_name' => 'Cetak Laporan' 
        ];

        echo view('partials/header', $data);
        echo view('report/nilai_semua', $data);
        echo view('partials/footer');
    }

    public function cetakPDF($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester)
    {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");
        $tglFoot = strftime("%d %B %Y");

        $nilaiSiswaModel = new DaftarnilaisiswaModel();
        $dataNilai = $nilaiSiswaModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel);

        // Create an instance of the class:
        $mpdf = new Mpdf(['orientation' => 'L']);

        $header = '<div style="border-bottom: 1px solid black; padding-bottom: 5px;">
                    <img src="assets/assets/img/smk_angkasa_1.png" style="width: 80px; float: left; margin-right: 12px;">
                    <h1 style="font-size: 24px; float: left; padding-top: 22px;">SI Manajemen Nilai</h1>      
                </div>';

        foreach ($dataNilai as $data) :
            $text = '<p><b>' . $data['kelas'] . ' ' . $data['nama_jurusan'] . ' ' . $data['nama_mapel'] . ' ' . $data['tahun_ajaran'] .
                '</b></p>';
        endforeach;

        $waktu = '<p>' . $tglHead . '</p>';

        $table = '<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center; font-size: 13px;">
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
                        <th rowspan="2">PTS</th>
                        <th rowspan="2">PAT</th>
                        <th rowspan="2">NA</th>
                        <th rowspan="2">NR</th>
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
        foreach ($dataNilai as $data) :
            $no++;
            $table .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $data['nis'] . '</td>
                        <td>' . $data['nisn'] . '</td>
                        <td style="text-align: left;">' . $data['nama_siswa'] . '</td>
                        <td>' . $data['nilai_1'] . '</td>
                        <td>' . $data['nilai_2'] . '</td>
                        <td>' . $data['nilai_3'] . '</td>
                        <td>' . $data['nilai_4'] . '</td>
                        <td>' . $data['nilai_5'] . '</td>
                        <td>' . $data['nilai_6'] . '</td>
                        <td>' . $data['nilai_7'] . '</td>
                        <td>' . $data['nilai_8'] . '</td>
                        <td>' . $data['nilai_9'] . '</td>
                        <td>' . $data['na_materi'] . '</td>
                        <td>' . $data['LM_1'] . '</td>
                        <td>' . $data['LM_2'] . '</td>
                        <td>' . $data['LM_3'] . '</td>
                        <td>' . $data['na_sumatif'] . '</td>
                        <td>' . $data['pts'] . '</td>
                        <td>' . $data['pat'] . '</td>
                        <td>' . $data['nilai_akhir'] . '</td>
                        <td>' . $data['nilai_rapor'] . '</td>
                    </tr>';
        endforeach;

        $table .= ' 
                </table>';

        $date = '<div style="text-align: right; margin-top:50px;">
                    <p>Jakarta, ' . $tglFoot . '</p>
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

        foreach ($dataNilai as $data) :
            $fileName = 'Nilai Rapor ' . $data['kelas'] . ' ' . $data['nama_jurusan'] . ' ' . $data['nama_mapel'] . ' ' . $data['tahun_ajaran'] . '.pdf';
        endforeach;

        // Output a PDF file directly to the browser
        $mpdf->Output($fileName, \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function cetakExcel($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester)
    {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");

        $spreadsheet = new Spreadsheet();
        $nilaiSiswaModel = new DaftarnilaisiswaModel();

        $dataNilai = $nilaiSiswaModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel);
        $sheetBaris = $spreadsheet->getActiveSheet();

        $header = 'SI Manajemen Nilai';
        foreach ($dataNilai as $data) :
            $text = $data['kelas'] . ' ' . $data['nama_jurusan'] . ' ' . $data['nama_mapel'] . ' ' . $data['tahun_ajaran'];
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
        $sheetBaris->mergeCells('S5:S6');
        $sheetBaris->mergeCells('T5:T6');
        $sheetBaris->mergeCells('U5:U6');
        $sheetBaris->mergeCells('V5:V6');

        $sheetBaris->setCellValue('N5', 'NA Materi');
        $sheetBaris->setCellValue('O5', 'LM 1');
        $sheetBaris->setCellValue('P5', 'LM 2');
        $sheetBaris->setCellValue('Q5', 'LM 3');
        $sheetBaris->setCellValue('R5', 'NA SUMATIF');
        $sheetBaris->setCellValue('S5', 'PTS');
        $sheetBaris->setCellValue('T5', 'PAT');
        $sheetBaris->setCellValue('U5', 'Nilai Akhir');
        $sheetBaris->setCellValue('V5', 'Nilai Rapor');

        $baris = 7;
        $no = 1;
        foreach ($dataNilai as $data) :
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
            $sheetBaris->setCellValue('S' . $baris, $data['pts']);
            $sheetBaris->setCellValue('T' . $baris, $data['pat']);
            $sheetBaris->setCellValue('U' . $baris, $data['nilai_akhir']);
            $sheetBaris->setCellValue('V' . $baris, $data['nilai_rapor']);
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

        $sheetBaris->getStyle('A5:V5')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheetBaris->getStyle('A7:D' . $lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheetBaris->getStyle('E7:V' . $lastRow)->applyFromArray([
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
        $sheetBaris->getStyle('A5:V' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Mengatur ukuran kolom agar otomatis menyesuaikan isi
        foreach (range('B', 'V') as $col) {
            $sheetBaris->getColumnDimension($col)->setAutoSize(true);
        }

        // Set nama file
        foreach ($dataNilai as $data) :
            $fileName = 'Nilai Rapor ' . $data['kelas'] . ' ' . $data['nama_jurusan'] . ' ' . $data['nama_mapel'] . ' ' . $data['tahun_ajaran'] . '.xlsx';
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
