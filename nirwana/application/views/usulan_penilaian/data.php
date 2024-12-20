<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    REKAP DATA
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('usulan_penilaian/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Data
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>No.</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Nama Objek Penilaian</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>NPWP</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>KPP Asal</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Jenis Penilaian</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Objek Penilaian</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Tahun Pajak</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Poin</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Asal Usulan</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>ND Usulan</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>User</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Status</th>
                    <th rowspan="2" class="text-center" style=vertical-align:middle>Aksi</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>S-PRINT</th>
                    <th rowspan="2" style=vertical-align:middle>Jatuh Tempo</th>
                    <th rowspan="2" style=vertical-align:middle>Monitoring</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>Laporan Penilaian</th>
                    <th colspan="5" class="text-center" style=vertical-align:middle>Tim Penilai</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>ND Pengiriman KPP</th>
                    <th colspan="2" class="text-center" style=vertical-align:middle>Laporan Hasil Analisis</th>
                    <th rowspan="2" style=vertical-align:middle>Surat Laporan Penilaian</th>
                </tr>
                <tr>
                    <th class="text-center" style=vertical-align:middle>Nomor</th>
                    <th class="text-center" style=vertical-align:middle>Tanggal</th>
                    <th style=vertical-align:middle>Nomor</th>
                    <th style=vertical-align:middle>Tanggal</th>
                    <th style=vertical-align:middle>Nomor</th>
                    <th style=vertical-align:middle>Tanggal</th>
                    <th style=vertical-align:middle>Supervisor</th>
                    <th style=vertical-align:middle>Ketua Tim</th>
                    <th style=vertical-align:middle>Anggota 1</th>
                    <th style=vertical-align:middle>Anggota 2</th>
                    <th style=vertical-align:middle>Anggota 3</th>
                    <th style=vertical-align:middle>Nomor</th>
                    <th style=vertical-align:middle>Tanggal</th>
                    <th style=vertical-align:middle>Nomor</th>
                    <th style=vertical-align:middle>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($supplier) :
                    $no = 1;
                    foreach ($supplier as $s) :
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
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $s['nm_objek_pn']; ?></td>
                            <td><?= $s['npwp']; ?></td>
                            <td><?= $s['kpp_asal']; ?></td>
                            <td><?= $s['jns_penilaian']; ?></td>
                            <td><?= $s['objek_penilaian']; ?></td>
                            <td><?= $s['tahun_pajak']; ?></td>
                            <td><?= $s['poin']; ?></td>
                            <td><?= $s['asal_usulan']; ?></td>
                            <td><?= $s['no_usulan']; ?></td>
                            <td><?= date('d F Y', strtotime($s['tgl_usulan'])); ?></td>
                            <td><?= $s['perekam']; ?></td>
                            <td>
                                <?php if ($s['status_usulan'] == "SELESAI") : ?>
                                    <span class="badge bg-success">SELESAI</span>
                                <?php elseif ($s['status_usulan'] == "DITOLAK") : ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                    <br>
                                    <span class="badge bg-secondary text-white"><?= $s['keterangan'] ?></span>
                                <?php elseif ($s['status_usulan'] == 'BELUM') : ?>
                                    <span class="badge bg-warning">Menunggu</span>
                                <?php elseif ($s['status_usulan'] == 'PROSES') : ?>
                                    <span class="badge bg-info">PROSES</span>
                                <?php endif; ?>
                            </td>
                            <th>
                                <a href="<?= base_url('usulan_penilaian/edit/') . $s['id_supplier'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('usulan_penilaian/delete/') . $s['id_supplier'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                            <td><?= $s['no_sprint']; ?></td>
                            <td><?= date('d F Y', strtotime($s['tgl_sprint'])); ?></td>
                            <?php if ($s['status_usulan'] == "SELESAI") { ?>
                                <td>-</td>
                                <td>-</td>
                            <?php } else { ?>
                                <td><?= $jatuh_tempo_sprint; ?></td>
                                <td><?= $format_monitoring; ?></td>
                            <?php } ?>
                            <td><?= $s['nomor_laporan']; ?></td>
                            <td><?= date('d F Y', strtotime($s['tanggal_laporan'])); ?></td>
                            <td><?= $s['supervisor']; ?></td>
                            <td><?= $s['ketua_tim']; ?></td>
                            <td><?= $s['anggota_1']; ?></td>
                            <td><?= $s['anggota_2']; ?></td>
                            <td><?= $s['anggota_3']; ?></td>
                            <td><?= $s['nd_kirim_kpp']; ?></td>
                            <td><?= date('d F Y', strtotime($s['tanggal_kirim_kpp'])); ?></td>
                            <td><?= $s['nomor_lha']; ?></td>
                            <td><?= date('d F Y', strtotime($s['tanggal_lha'])); ?></td>  
                            <td>
                                <?php if (!empty($s['surat_laporan']) && file_exists('public/upload_laporan/' . $s['surat_laporan'])): ?>
                                    <a href="<?= base_url('public/upload_laporan/') . $s['surat_laporan'] ?>" class="btn btn-rounded-circle btn-info ml-5"><i class="fa fa-eye"></i></a>
                                    <a href="<?= base_url('public/upload_laporan/') . $s['surat_laporan'] ?>" class="btn btn-rounded-circle btn-secondary" download><i class="fa fa-download"></i></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-rounded-circle btn-info ml-5 disabled"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="btn btn-rounded-circle btn-secondary disabled"><i class="fa fa-download"></i></a>
                                <?php endif; ?>
                            </td>

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