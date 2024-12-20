<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    REKAP DATA
                </h4>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>No.</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Aksi</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Nama Objek Penilaian</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>NPWP</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Tahun Pajak</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>S-PRINT</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle><b>Jatuh Tempo</th></b>
                    <th rowspan="2" class="text-center" style=vertical-align:middle><b>Monitoring Jatuh Tempo</th></b>
                    <th colspan="2" class="text-center" style=vertical-align:middle>Laporan Penilaian</th>
                    <th colspan="5" class="text-center" style=vertical-align:middle>Tim Penilai</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>ND Pengiriman KPP</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>Laporan Hasil Analisis</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Surat Laporan Penilaian</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>User</th>
                </tr>
                <tr>
                    <th class="text-center" style=vertical-align:middle>Nomor</th>
                    <th class="text-center" style=vertical-align:middle>Tanggal</th>
                    <th class="text-center" style=vertical-align:middle>Nomor</th>
                    <th class="text-center" style=vertical-align:middle>Tanggal</th>
                    <th class="text-center" style=vertical-align:middle>Supervisor</th>
                    <th class="text-center" style=vertical-align:middle>Ketua Tim</th>
                    <th class="text-center" style=vertical-align:middle>Anggota 1</th>
                    <th class="text-center" style=vertical-align:middle>Anggota 2</th>
                    <th class="text-center" style=vertical-align:middle>Anggota 3</th>
                    <th class="text-center" style=vertical-align:middle>Nomor</th>
                    <th class="text-center" style=vertical-align:middle>Tanggal</th>
                    <th class="text-center" style=vertical-align:middle>Nomor</th>
                    <th class="text-center" style=vertical-align:middle>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if ($supplier) :

                    $no = 1;
                    foreach ($join as $s) :
                        $hari_ini = date('Y-m-d');
                        $tanggal_sprint = $s['tgl_sprint'];
                        $jenis_penilaian = $s['jns_penilaian'];
                        $ref_jns_penilaian = $s['jenis_penilaian'];
                        $ref_jt_bulan = $s['jt_bulan'];
                        $ref_jt_hari = $s['jt_hari'];
                        $ref_laporan = $s['nomor_laporan'];

                        //function menghitung selisih tanggal
                        if ($tanggal_sprint == '0000-00-00') {
                            $jatuh_tempo_sprint = '-';
                        } else {
                            if ($jenis_penilaian == $ref_jns_penilaian) {
                                $jatuh_tempo_sprint = date('Y-m-d', strtotime('+' . $ref_jt_bulan . ' month +' . $ref_jt_hari . ' days', strtotime($tanggal_sprint)));
                            }
                        };

                        //function menghitung selisih hari/notifikasi hari
                        if ($jatuh_tempo_sprint == '-') {
                            $format_monitoring = '-';
                        } else {
                            if (strtotime($jatuh_tempo_sprint) > strtotime($hari_ini)) {
                                $begin = date_create($hari_ini);
                                $end = date_create($jatuh_tempo_sprint);
                                $diff = date_diff($end, $begin);
                                $format_monitoring = $diff->format("SISA %m BULAN %d HARI LAGI !");
                            } elseif (strtotime($jatuh_tempo_sprint) < strtotime($hari_ini)) {
                                $begin = date_create($hari_ini);
                                $end = date_create($jatuh_tempo_sprint);
                                $diff = date_diff($end, $begin);
                                $format_monitoring = $diff->format("MELEWATI %m BULAN %d HARI !");
                            }
                        };

                ?>
                        <tr style="background-color: <?= $s['status_usulan'] == 'DITOLAK' ? '#FF8A8A' : '' ?>;">
                            <td><?= $no++; ?></td>
                            <?php if ($s['status_usulan'] == 'BELUM') { ?>
                                <th>
                                    <a href="<?= base_url('tindak_lanjut_penilaian/edit/') . $s['id_supplier'] ?>" class="btn btn-circle btn-success btn-sm"><i class="fa fa-check"></i></a>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-circle btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal-<?= $s['id_supplier'] ?>">
                                        <i class="fa fa-times"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-<?= $s['id_supplier'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Alasan Penolakan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('usulan_penilaian/tolak/') . $s['id_supplier'] ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="alasan">Alasan</label>
                                                            <textarea class="form-control" name="alasan" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" >Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            <?php } elseif ($s['status_usulan'] == 'PROSES') {
                            ?>
                                <th>
                                    <a href="<?= base_url('tindak_lanjut_penilaian/edit/') . $s['id_supplier'] ?>" class="btn btn-circle btn-info btn-sm"><i class="fa fa-paper-plane"></i></a>
                                    <a href="<?= base_url('tindak_lanjut_penilaian/revisi/') . $s['id_supplier'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-pen"></i></a>
                                </th>
                            <?php } elseif ($s['status_usulan'] == 'SELESAI') {
                            ?>
                                <th>
                                    <a href="<?= base_url('tindak_lanjut_penilaian/edit/') . $s['id_supplier'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-pen"></i></a>
                                </th>
                            <?php } elseif ($s['status_usulan'] == 'SUDAH') {
                            ?>
                                <th>
                                    <a href="<?= base_url('tindak_lanjut_penilaian/edit/') . $s['id_supplier'] ?>" class="btn btn-circle btn-success btn-sm"><i class="fa fa-check"></i></a>
                                </th>
                            <?php } elseif ($s['status_usulan'] == 'DITOLAK') { ?>
                                <th class=""></th>
                            <?php } else { ?>
                                <th></th>
                            <?php } ?>
                            <td><?= $s['nm_objek_pn']; ?></td>
                            <td><?= $s['npwp']; ?></td>
                            <td><?= $s['tahun_pajak']; ?></td>
                            <td><?= $s['no_sprint']; ?></td>
                            <td><?php if ($s['tgl_sprint'] == '0000-00-00') {
                                    echo "";
                                } else {
                                    echo $s['tgl_sprint'];
                                } ?></td>
                            <td>
                                <b>
                                    <?php
                                    if (($s['no_sprint'] !== null) && ($s['nomor_laporan'] == null)) {
                                        echo $jatuh_tempo_sprint;
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </b>
                            </td>
                            <td>
                                <b>
                                    <?php
                                    if (($s['no_sprint'] !== null) && ($s['nomor_laporan'] == null)) {
                                        echo $format_monitoring;
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </b>
                            </td>
                            <td><?= $s['nomor_laporan']; ?></td>
                            <td><?php if ($s['tanggal_laporan'] == '0000-00-00') {
                                    echo "";
                                } else {
                                    echo $s['tanggal_laporan'];
                                } ?></td>
                            <td><?= $s['supervisor']; ?></td>
                            <td><?= $s['ketua_tim']; ?></td>
                            <td><?= $s['anggota_1']; ?></td>
                            <td><?= $s['anggota_2']; ?></td>
                            <td><?= $s['anggota_3']; ?></td>
                            <td><?= $s['nd_kirim_kpp']; ?></td>
                            <td><?php if ($s['tanggal_kirim_kpp'] == '0000-00-00') {
                                    echo "";
                                } else {
                                    echo $s['tanggal_kirim_kpp'];
                                } ?></td>
                            <td><?= $s['nomor_lha']; ?></td>
                            <td><?php if ($s['tanggal_lha'] == '0000-00-00') {
                                    echo "";
                                } else {
                                    echo $s['tanggal_lha'];
                                } ?></td>
                            <td>
                                <?php if (!empty($s['surat_laporan']) && file_exists('public/upload_laporan/' . $s['surat_laporan'])): ?>
                                    <a href="<?= base_url('public/upload_laporan/') . $s['surat_laporan'] ?>" class="btn btn-rounded-circle btn-info ml-5"><i class="fa fa-eye"></i></a>
                                    <a href="<?= base_url('public/upload_laporan/') . $s['surat_laporan'] ?>" class="btn btn-rounded-circle btn-secondary" download><i class="fa fa-download"></i></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-rounded-circle btn-info ml-5 disabled"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="btn btn-rounded-circle btn-secondary disabled"><i class="fa fa-download"></i></a>
                                <?php endif; ?>
                            </td>
                            <td><?= $s['perekam']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>



    </div>
</div>


