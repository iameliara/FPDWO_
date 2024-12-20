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
                <?= form_open('', [], ['id_supplier' => $supplier['id_supplier']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nm_objek_pn">NAMA OBJEK</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('nm_objek_pn', $supplier['nm_objek_pn']); ?>" name="nm_objek_pn" id="nm_objek_pn" type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()"></input>
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
                            <input value="<?= set_value('npwp', $supplier['npwp']); ?>" name="npwp" id="npwp" type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()"></input>
                        </div>
                        <?= form_error('npwp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_usulan">NO USULAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('no_usulan', $supplier['no_usulan']); ?>" name="no_usulan" id="no_usulan" type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()"></input>
                        </div>
                        <?= form_error('no_usulan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_usulan">TGL USULAN</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tgl_usulan', $supplier['tgl_usulan']); ?>" name="tgl_usulan" id="date4" type="text" class="form-control">
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

                                        if($supplier['jns_penilaian'] == $s['jenis_penilaian']){
                                            $select="selected";
                                        } else {
                                            $select="";
                                        } 
                                ?>
                                <option <?=$select?><?=$s['jenis_penilaian']?> data-nilai="<?=$s['poin']?>"><?=$s['jenis_penilaian']?></option>
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
                                    foreach ($ref_objek_penilaian as $s ) :

                                        if($supplier['objek_penilaian'] == $s['objek_penilaian']){
                                            $select="selected";
                                        } else {
                                            $select="";
                                        } 
                                ?>
                                <option <?=$select?>><?=$s['objek_penilaian']?></option>
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
                                <option value="" disabled>PILIH TAHUN PAJAK</option>
                                <?php
                                    for($i=date('Y'); $i>=date('Y')-4; $i-=1) :
                                ?>
                                <?php    
                                if($supplier['tahun_pajak'] == $i){
                                     $select="selected"; } ?>
                                <option <?=$select?>> <?= $i ?>
                                <?php endfor; ?>
                                </option>
                                <option value="<?= $supplier['tahun_pajak']?>" selected><?=$supplier['tahun_pajak']?>
                                </option>

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
                        <input value="<?= set_value('poin', $supplier['poin']); ?>" type= text name="poin" id="poin" class="form-control" readonly>
                                
                    
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('poin', '<small class="text-danger">', '</small>'); ?>
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
                                if($supplier['asal_usulan'] == $s['nama_sumber_penilaian']) echo 'selected=selected'?>><?=$s['nama_sumber_penilaian']?>
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

<script>
function nilai_poin() {
  var selectedOption = document.getElementById("jns_penilaian").options[document.getElementById("jns_penilaian").selectedIndex];
  var selectedNilai = selectedOption.getAttribute('data-nilai');
  document.getElementById("poin").value = selectedNilai;
}
</script>