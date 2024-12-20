<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Data
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('tindak_lanjut_penilaian') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', ['enctype' => 'multipart/form-data'], ['id_supplier' => $supplier['id_supplier']]); ?>

                <?php if ($supplier['status_usulan'] == 'BELUM') : ?>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nm_objek_pn">NAMA OBJEK</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input readonly value="<?= set_value('nm_objek_pn', $supplier['nm_objek_pn']); ?>" name="nm_objek_pn" id="nm_objek_pn" type="text" class="form-control" placeholder="Nama Supplier..."></input>
                            </div>
                            <?= form_error('nm_objek_pn', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div hidden class="row form-group">
                        <label class="col-md-3 text-md-right" for="perekam_tl">PEREKAM TINDAK LANJUT</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input value="<?= userdata('nama'); ?>" name="perekam_tl" id="perekam_tl" type="text" class="form-control" placeholder="">
                            </div>
                            <?= form_error('perekam_tl', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="npwp">NPWP</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input readonly value="<?= set_value('npwp', $supplier['npwp']); ?>" name="npwp" id="npwp" type="text" class="form-control" placeholder="NPWP"></input>
                            </div>
                            <?= form_error('npwp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div hidden class="row form-group">
                        <label class="col-md-3 text-md-right" for="kpp_asal">KPP ASAL</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input value="<?= set_value('kpp_asal', $supplier['kpp_asal']); ?>" name="kpp_asal" id="kpp_asal" type="text" class="form-control"></input>
                            </div>
                            <?= form_error('kpp_asal', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div hidden class="row form-group">
                        <label class="col-md-3 text-md-right" for="status_usulan">STATUS TINDAK LANJUT</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input value="<?= htmlspecialchars($supplier['status_usulan'] ?? '') ?>" name="status_usulan" id="status_usulan" type="text" class="form-control">
                            </div>
                            <?= form_error('status_usulan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tahun_pajak">TAHUN PAJAK</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input readonly value="<?= set_value('tahun_pajak', $supplier['tahun_pajak']); ?>" name="tahun_pajak" id="tahun_pajak" type="text" class="form-control" placeholder="NPWP"></input>
                            </div>
                            <?= form_error('tahun_pajak', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="no_sprint">NO S-PRINT</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input value="<?= set_value('no_sprint', $supplier['no_sprint']); ?>" name="no_sprint" id="no_sprint" type="text" class="form-control"></input>
                            </div>
                            <?= form_error('no_sprint', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tgl_sprint">TGL S-PRINT</label>
                        <div class="col-md-9">
                            <input value="<?php if ($supplier['tgl_sprint'] == '0000-00-00') {
                                                echo "";
                                            } else if ($supplier['tgl_sprint'] !== '0000-00-00') {
                                                echo $supplier['tgl_sprint'];
                                            }
                                            echo set_value('tgl_sprint'); ?>" name="tgl_sprint" id="date1" type="text" class="form-control" placeholder="">
                            <?= form_error('tgl_sprint', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="supervisor">SUPERVISOR</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="supervisor" id="supervisor" class="custom-select">
                                    <option value="" selected disabled>PILIH SUPERVISOR</option>
                                    <?php
                                    foreach ($ref_pejabat_penilaian as $s) :

                                        if (set_value('supervisor') == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else if ($supplier['supervisor'] == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else {
                                            $select = "";
                                        };
                                    ?>
                                        <option <?= $select ?>><?= $s['pejabat_penilai'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                </div>
                            </div>
                            <?= form_error('supervisor', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="ketua_tim">KETUA TIM</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="ketua_tim" id="ketua_tim" class="custom-select">
                                    <option value="" selected disabled>PILIH KETUA TIM</option>
                                    <?php
                                    foreach ($ref_pejabat_penilaian as $s) :

                                        if (set_value('ketua_tim') == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else if ($supplier['ketua_tim'] == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else {
                                            $select = "";
                                        };
                                    ?>
                                        <option <?= $select ?>><?= $s['pejabat_penilai'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                </div>
                            </div>
                            <?= form_error('ketua_tim', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="anggota_1">ANGGOTA 1</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="anggota_1" id="anggota_1" class="custom-select">
                                    <option value="" selected disabled>PILIH ANGGOTA 1 PENILAI</option>
                                    <?php
                                    foreach ($ref_pejabat_penilaian as $s) :

                                        if (set_value('anggota_1') == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else if ($supplier['anggota_1'] == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else {
                                            $select = "";
                                        };                                ?>
                                        <option <?= $select ?>><?= $s['pejabat_penilai'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                </div>
                            </div>
                            <?= form_error('anggota_1', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="anggota_2">ANGGOTA 2</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="anggota_2" id="anggota_2" class="custom-select">
                                    <option value="" selected disabled>PILIH ANGGOTA 2 PENILAI</option>
                                    <?php
                                    foreach ($ref_pejabat_penilaian as $s) :

                                        if (set_value('anggota_2') == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else if ($supplier['anggota_2'] == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else {
                                            $select = "";
                                        };
                                    ?>
                                        <option <?= $select ?>><?= $s['pejabat_penilai'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                </div>
                            </div>
                            <?= form_error('anggota_2', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="anggota_3">ANGGOTA 3</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select name="anggota_3" id="anggota_3" class="custom-select">
                                    <option value="" selected disabled>PILIH ANGGOTA 3 PENILAI</option>
                                    <?php
                                    foreach ($ref_pejabat_penilaian as $s) :

                                        if (set_value('anggota_3') == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else if ($supplier['anggota_3'] == $s['pejabat_penilai']) {
                                            $select = "selected";
                                        } else {
                                            $select = "";
                                        };
                                    ?>
                                        <option <?= $select ?>><?= $s['pejabat_penilai'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                </div>
                            </div>
                            <?= form_error('anggota_3', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                <?php else : ?>
                    
                    <input type="hidden" value="<?= set_value('nm_objek_pn', $supplier['nm_objek_pn']); ?>" name="nm_objek_pn" id="nm_objek_pn" class="form-control"></input>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="">LAPORAN PENILAIAN</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input value="<?= set_value('nomor_laporan', $supplier['nomor_laporan']); ?>" name="nomor_laporan" id="nomor_laporan" type="text" class="form-control" required></input>
                            </div>
                            <?= form_error('nomor_laporan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_laporan">TGL PENILAIAN</label>
                        <div class="col-md-9">
                            <input value="<?php if ($supplier['tanggal_laporan'] == '0000-00-00') {
                                                echo "";
                                            } else if ($supplier['tanggal_laporan'] !== '0000-00-00') {
                                                echo $supplier['tanggal_laporan'];
                                            }
                                            echo set_value('tanggal_laporan'); ?>" name="tanggal_laporan" id="date4" type="text" class="form-control" placeholder="">
                            <?= form_error('tanggal_laporan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nd_kirim_kpp">ND KIRIM KPP</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input value="<?= set_value('nd_kirim_kpp', $supplier['nd_kirim_kpp']); ?>" name="nd_kirim_kpp" id="nd_kirim_kpp" type="text" class="form-control"></input>
                            </div>
                            <?= form_error('nd_kirim_kpp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_kirim_kpp">TGL KIRIM KPP</label>
                        <div class="col-md-9">
                            <input value="<?php if ($supplier['tanggal_kirim_kpp'] == '0000-00-00') {
                                                echo "";
                                            } else if ($supplier['tanggal_kirim_kpp'] !== '0000-00-00') {
                                                echo $supplier['tanggal_kirim_kpp'];
                                            }
                                            echo set_value('tanggal_kirim_kpp'); ?>" name="tanggal_kirim_kpp" id="date3" type="text" class="form-control" placeholder="">
                            <?= form_error('tanggal_kirim_kpp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nomor_lha">LAPORAN HASIL ANALISIS</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                </div>
                                <input value="<?= set_value('nomor_lha', $supplier['nomor_lha']); ?>" name="nomor_lha" id="nomor_lha" type="text" class="form-control"></input>
                            </div>
                            <?= form_error('nomor_lha', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_lha">TGL HASIL ANALISIS</label>
                        <div class="col-md-9">
                            <input value="<?php if ($supplier['tanggal_lha'] == '0000-00-00') {
                                                echo "";
                                            } else if ($supplier['tanggal_lha'] !== '0000-00-00') {
                                                echo $supplier['tanggal_lha'];
                                            }
                                            echo set_value('tanggal_lha'); ?>" name="tanggal_lha" id="date10" type="text" class="form-control" placeholder="">
                            <?= form_error('tanggal_lha', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="surat_laporan">SURAT LAP. PENILAIAN</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= set_value('surat_laporan', $supplier['surat_laporan']); ?>" name="surat_laporan" id="surat_laporan" type="file" class="form-control"></input>
                            </div>
                            <?= form_error('surat_laporan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>