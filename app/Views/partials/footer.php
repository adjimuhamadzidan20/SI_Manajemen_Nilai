                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; SI Manajemen Nilai Siswa <?= date("Y"); ?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets'); ?>/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets'); ?>/js/datatables-simple-demo.js"></script>
        <script src="<?= base_url('assets'); ?>/js/jquery-3.6.0.js"></script>

        <script type="text/javascript">
            $('#ubah_periode').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)

                let id = button.data('id')
                let kd_ajaran = button.data('kdajaran')
                let semester1 = button.data('semester1')
                let semester2 = button.data('semester2')
                let tahun_ajaran = button.data('tahunajaran')

                let modal = $(this)

                modal.find('#id').val(id)
                modal.find('#kd_ajaran').val(kd_ajaran)
                modal.find('#semester_1').val(semester1)
                modal.find('#semester_2').val(semester2)
                modal.find('#tahun_ajaran').val(tahun_ajaran)
            })

            $('#ubah_jurusan').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)

                let id = button.data('id')
                let kd_jurusan = button.data('kdjurusan')
                let jurusan = button.data('namajurusan')
                let namapanjang = button.data('namapanjang')

                let modal = $(this)

                modal.find('#id').val(id)
                modal.find('#kd_jur_edit').val(kd_jurusan)
                modal.find('#jurusan_edit').val(jurusan)
                modal.find('#panjangjurusan_edit').val(namapanjang)
            })

            $('#ubah_kelas').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)

                let id = button.data('id')
                let kd_kelas = button.data('kdkelas')
                let jurusan = button.data('jurusan')
                let kelas = button.data('kelas')
                let periode = button.data('tahun')

                let modal = $(this)

                modal.find('#id').val(id)
                modal.find('#input_kdkelas').val(kd_kelas)
                modal.find('#input_keahlian').val(jurusan)
                modal.find('#input_kelas').val(kelas)
                modal.find('#input_periode').val(periode)
            })

            $('#ubah_mapel').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)

                let id = button.data('id')
                let kd_mapel = button.data('kdmapel')
                let mapel = button.data('mapel')
                let kelas = button.data('kelas')
                let guru = button.data('guru')

                let modal = $(this)

                modal.find('#id').val(id)
                modal.find('#input_kdmapel').val(kd_mapel)
                modal.find('#input_mapel').val(mapel)
                modal.find('#input_kelas').val(kelas)
                modal.find('#input_guru').val(guru)
            })

            $('#ubah_murid').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)

                let id = button.data('id')
                let kd_siswa = button.data('kdsiswa')
                let nis = button.data('nis')
                let nisn = button.data('nisn')
                let siswa = button.data('siswa')
                let kelas = button.data('kelas')
                let jurusan = button.data('jurusan')
                let periode = button.data('periode')

                let modal = $(this)

                modal.find('#id').val(id)
                modal.find('#input_kdsiswa').val(kd_siswa)
                modal.find('#input_nis').val(nis)
                modal.find('#input_nisn').val(nisn)
                modal.find('#input_murid').val(siswa)
                modal.find('#input_kelas').val(kelas)
                modal.find('#input_jurusan').val(jurusan)
                modal.find('#input_tahun').val(periode)
            })

            $('#ubah_nilai').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)
                let idtugas = button.data('idtugas')
                let idsiswa = button.data('idsiswa')
                let idmapel = button.data('idmapel')
                let kelas = button.data('kelas')
                let idjurusan = button.data('idjurusan')
                let idperiode = button.data('idperiode')
                let semester = button.data('semester')
                let nilai1 = button.data('nilai1')
                let nilai2 = button.data('nilai2')
                let nilai3 = button.data('nilai3')
                let nilai4 = button.data('nilai4')
                let nilai5 = button.data('nilai5')
                let nilai6 = button.data('nilai6')
                let nilai7 = button.data('nilai7')
                let nilai8 = button.data('nilai8')
                let nilai9 = button.data('nilai9')

                let modal = $(this)

                modal.find('#id').val(idtugas)
                modal.find('#input_pesertadidik').val(idsiswa)
                modal.find('#input_namamapel').val(idmapel)
                modal.find('#input_kelasmurid').val(kelas)
                modal.find('#input_kelasjurusan').val(idjurusan)
                modal.find('#input_thnperiode').val(idperiode)
                modal.find('#input_periodesemester').val(semester)
                modal.find('#input_tp_1').val(nilai1)
                modal.find('#input_tp_2').val(nilai2)
                modal.find('#input_tp_3').val(nilai3)
                modal.find('#input_tp_4').val(nilai4)
                modal.find('#input_tp_5').val(nilai5)
                modal.find('#input_tp_6').val(nilai6)
                modal.find('#input_tp_7').val(nilai7)
                modal.find('#input_tp_8').val(nilai8)
                modal.find('#input_tp_9').val(nilai9)
            })

        </script>
    </body>
</html>