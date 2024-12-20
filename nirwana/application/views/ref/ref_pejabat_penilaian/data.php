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
                <a href="<?= base_url('ref/ref_pejabat_penilaian/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                    <th rowspan="2" class="text-center" style = vertical-align:middle>No.</th>
                    <th rowspan="2" class="text-center" style = vertical-align:middle>NIP9</th>
                    <th rowspan="2" class="text-center" style = vertical-align:middle>Pejabat Penilai</th>
                    <th class="text-center" style = vertical-align:middle>Aksi</th>
                </tr>
                <tr>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($ref_pejabat_penilaian) :
                    $no = 1;
                    foreach ($ref_pejabat_penilaian as $s) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $s['nip9']; ?></td>
                            <td><?= $s['pejabat_penilai']; ?></td>
                            <th>
                                <a href="<?= base_url('ref/ref_pejabat_penilaian/edit/') . $s['id'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('ref/ref_pejabat_penilaian/delete/') . $s['id'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
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