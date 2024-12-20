<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Data
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('usulan_penilaian') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open(); ?>
                <div hidden class="row form-group">
                    <label class="col-md-3 text-md-right" for="perekam">PEREKAM</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span  class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input  value="<?= userdata('nama'); ?>" name="perekam" id="perekam" type="text" class="form-control" placeholder="">
                        </div>
                        <?= form_error('perekam', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div hidden class="row form-group">
                    <label class="col-md-3 text-md-right" for="status_usulan">STATUS USULAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span  class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input  value="BELUM" name="status_usulan" id="status_usulan" type="text" class="form-control" placeholder="">
                        </div>
                        <?= form_error('status_usulan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nm_objek_pn">NAMA OBJEK</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('nm_objek_pn'); ?>" name="nm_objek_pn" id="nm_objek_pn" type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <?= form_error('nm_objek_pn', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="npwp">NPWP</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('npwp'); ?>" name="npwp" id="npwp" type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <?= form_error('npwp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kpp_asal">KPP ASAL</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input readonly value="<?= $this->session->userdata('login_session')['kpp'] ?>" name="kpp_asal" id="kpp_asal" type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <?= form_error('kpp_asal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="asal_usulan">ASAL USULAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="asal_usulan" id="asal_usulan" class="custom-select">
                                <option value="" selected disabled>PILIH ASAL USULAN</option>
                                <?php
                                    foreach ($ref_sumber_penilaian as $s) :
                                ?>
                                <option value="<?=$s['nama_sumber_penilaian']?>"
                                <?php 
                                if(set_value('asal_usulan') == $s['nama_sumber_penilaian']) echo 'selected=selected'?>><?=$s['nama_sumber_penilaian']?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('asal_usulan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_usulan">NO USULAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('no_usulan'); ?>" name="no_usulan" id="no_usulan" type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <?= form_error('no_usulan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_usulan">TGL USULAN</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tgl_usulan'); ?>" name="tgl_usulan" id="date1" type="text" class="form-control" placeholder="PILIH TANGGAL USULAN">
                        <?= form_error('tgl_usulan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>                
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jns_penilaian">JENIS PENILAIAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="jns_penilaian" id="jns_penilaian" class="custom-select" onchange="nilai_poin()">
                                <option value="" selected disabled>PILIH JENIS PENILAIAN</option>
                                <?php
                                    foreach ($ref_jenis_penilaian as $s) :
                                ?>
                                <option value="<?=$s['jenis_penilaian']?>" data-nilai="<?=$s['poin']?>"
                                <?php 
                                if(set_value('jns_penilaian') == $s['jenis_penilaian']) echo 'selected=selected'?>><?=$s['jenis_penilaian']?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('jns_penilaian', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="objek_penilaian">OBJEK PENILAIAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="objek_penilaian" id="objek_penilaian" class="custom-select">
                                <option value="" selected disabled>PILIH OBJEK PENILAIAN</option>
                                <?php
                                    foreach ($ref_objek_penilaian as $s) :
                                ?>
                                <option value="<?=$s['objek_penilaian']?>"
                                <?php 
                                if(set_value('objek_penilaian') == $s['objek_penilaian']) echo 'selected=selected'?>><?=$s['objek_penilaian']?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('objek_penilaian', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tahun_pajak">TAHUN PAJAK</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="tahun_pajak" id="tahun_pajak" class="custom-select">
                                <option value="" selected disabled>PILIH TAHUN PAJAK </option>
                                <?php
                                    for($i=date('Y'); $i>=date('Y')-5; $i-=1) :
                                ?>
                                <option value="<?= $i?>"
                                <?php    
                                if(set_value('tahun_pajak') == $i) echo 'selected=selected'?>><?= $i ?>
                                <?php endfor; ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('tahun_pajak', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="poin">POIN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type= text name="poin" id="poin" class="form-control" readonly>

                            </input>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('poin', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <style>
                    #checkbox {
                        display: inline-flex;
                        align-items: center;
                    }

                    .custom-label {
                        width: auto; 
                        text-align: left;
                        padding-top: 14px;
                        margin-left: 42px;
                        font-size: 18px;
                    }
                    .form-check-input {
                        width: 18px;
                        height: 18px;
                        margin-left: 16px;
                    }
                </style>
                <div class="flex justify-content-center pl-4">
                <div class="form-check" id="checkbox">
                    <label class="custom-label" for="flexCheckDefault">
                        Berita Acara Bantuan Penilaian
                    </label>
                    <input class="form-check-input" required type="checkbox" name="Berita_Acara_Bantuan_Penilaian" value="true" id="flexCheckDefault">
                </div>
                <div class="form-check" id="checkbox">
                    <label class="custom-label" for="flexCheckDefault">
                        Lembar Analisa Bantuan Penilaian
                    </label>
                    <input class="form-check-input" required type="checkbox" name="Lembar_Analisa_Bantuan_Penilaian" value="true" id="flexCheckDefault">
                </div>
                </div>
                <div class="form-check">
                    <div class="col-md-9 offset-md-3 mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script>
function nilai_poin() {
  var selectedOption = document.getElementById("jns_penilaian").options[document.getElementById("jns_penilaian").selectedIndex];
  var selectedNilai = selectedOption.getAttribute('data-nilai');
  document.getElementById("poin").value = selectedNilai;
}
</script>