<?php

namespace App\Controllers;
use App\Models\PeriodeajaranModel;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;
use App\Models\DaftarnilaipasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Mpdf\Mpdf;

class Daftarnilai_pas extends BaseController
{
    public function nilai_pas_periode($thn_ajaran) {
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
        echo view('daftar_nilaipas_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $nilaiPasModel = new DaftarnilaipasModel();

        $namaMapel = $this->request->getPost('nama_mapel');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $idMapel = $this->request->getPost('id_mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPas = $this->request->getPost('nilai_pas');

        $return = $nilaiPasModel->tambahDataNilaiPas($pesertaDidik, $idMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPas);

        if ($return) {
            $pesan = 'Nilai PAS berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Nama peserta didik sudah ada!';
            session()->setFlashData('info', $pesan);
        }

        return redirect()->to('/daftar_nilai_pas/peserta_didik/'.$kelas.'/'.$jurusan.'/'.$namaMapel.'/'.$idMapel.'/'.
        $periodeAjaran.'/'.$semester);
    }

     public function ubah() {
        $nilaiPasModel = new DaftarnilaipasModel();

        $namaMapel = $this->request->getPost('nama_mapel');
        $id = $this->request->getPost('id');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $idMapel = $this->request->getPost('id_mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPas = $this->request->getPost('nilai_pas');

        $return = $nilaiPasModel->ubahDataNilaiPas($id, $pesertaDidik, $idMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPas);

        if ($return) {
            $pesan = 'Nilai PAS berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Nilai PAS gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_nilai_pas/peserta_didik/'.$kelas.'/'.$jurusan.'/'.$namaMapel.'/'.$idMapel.'/'.
        $periodeAjaran.'/'.$semester);
    }

    public function peserta_didik($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $mapelModel = new DaftarmapelModel();
        $nilaiPasModel = new DaftarnilaipasModel();
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
            'nilai' => $nilaiPasModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel),
            'jumlah' => $nilaiPasModel->jumlahData($semester, $idPeriode, $kelas, $jurusan, $idMapel),
            'linkActive' => 'daftar_nilai' 
        ];

        echo view('partials/header');
        echo view('nilaipas_siswa', $data);
        echo view('partials/footer');
    }

    public function cetakPDF($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");
        $tglFoot = strftime("%d %B %Y");

        $nilaiPasModel = new DaftarnilaipasModel();
        $dataNilaiPAS = $nilaiPasModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel);

         // Create an instance of the class:
        $mpdf = new Mpdf();

        $header = '<div style="border-bottom: 1px solid black; padding-bottom: 5px;">
                    <img src="assets/assets/img/smk_angkasa_1.png" style="width: 80px; float: left; margin-right: 12px;">
                    <h1 style="font-size: 24px; float: left; padding-top: 22px;">SI Manajemen Nilai</h1>      
                </div>';

        foreach ($dataNilaiPAS as $data) :
            $text = '<p><b>'. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'] .
            '</b></p>';
        endforeach;

        $waktu = '<p>'. $tglHead .'</p>';

        $table = '<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center; font-size: 13px;">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama Peserta Didik</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai PAS</th>
                        </tr>';

                        $no = 0;
                        foreach ($dataNilaiPAS as $data) :
                        $no++;
                        $table .= ' <tr>
                                        <td>'. $no .'</td>
                                        <td>'. $data['nis'] .'</td>
                                        <td>'. $data['nisn'] .'</td>
                                        <td>'. $data['nama_siswa'] .'</td>
                                        <td>'. $data['nama_mapel'] .'</td>
                                        <td>'. $data['nilai_pas'] .'</td>
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

        foreach ($dataNilaiPAS as $data) :
            $fileName = 'Nilai PAS '. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'].'.pdf';
        endforeach;

        // Output a PDF file directly to the browser
        $mpdf->Output($fileName, \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function cetakExcel($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $tglHead = strftime("%A, %d %B %Y | %T");

        $spreadsheet = new Spreadsheet();
        $nilaiPasModel = new DaftarnilaipasModel();

        $dataNilaiPAS = $nilaiPasModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel);
        $sheetBaris = $spreadsheet->getActiveSheet();

        $header = 'SI Manajemen Nilai';
        foreach ($dataNilaiPAS as $data) :
            $text = $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'];
        endforeach;
        $waktu = $tglHead;

        $sheetBaris->setCellValue('A1', $header);
        $sheetBaris->setCellValue('A2', $text);
        $sheetBaris->setCellValue('A3', $waktu);

        $sheetBaris->setCellValue('A5', 'No');
        $sheetBaris->setCellValue('B5', 'NIS');
        $sheetBaris->setCellValue('C5', 'NISN');
        $sheetBaris->setCellValue('D5', 'Nama Peserta Didik');
        $sheetBaris->setCellValue('E5', 'Mata Pelajaran');
        $sheetBaris->setCellValue('F5', 'Nilai PAS');

        $baris = 6;
        $no = 1;
        foreach ($dataNilaiPAS as $data) :
            $sheetBaris->setCellValue('A' . $baris, $no++);
            $sheetBaris->setCellValue('B' . $baris, $data['nis']);
            $sheetBaris->setCellValue('C' . $baris, $data['nisn']);
            $sheetBaris->setCellValue('D' . $baris, $data['nama_siswa']);
            $sheetBaris->setCellValue('E' . $baris, $data['nama_mapel']);
            $sheetBaris->setCellValue('F' . $baris, $data['nilai_pas']);
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

        $sheetBaris->getStyle('A5:F5')->applyFromArray([
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
        $sheetBaris->getStyle('A5:F'. $lastRow)->applyFromArray([
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
        foreach (range('B', 'F') as $col) {
            $sheetBaris->getColumnDimension($col)->setAutoSize(true);
        }

        // Set nama file
        foreach ($dataNilaiPAS as $data) :
            $fileName = 'Nilai PAS '. $data['kelas'] .' '. $data['nama_jurusan'] .' '. $data['nama_mapel'] .' '. $data['tahun_ajaran'].'.xlsx';
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
