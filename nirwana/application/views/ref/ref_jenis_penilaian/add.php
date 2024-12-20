<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            FORM TAMBAH DATA
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('ref/ref_jenis_penilaian') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jenis_penilaian">JENIS PENILAIAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('jenis_penilaian'); ?>" name="jenis_penilaian" id="jenis_penilaian" type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <?= form_error('jenis_penilaian', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="poin">POIN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input value="<?= set_value('poin'); ?>" name="poin" id="poin" type="text" class="form-control" placeholder="">
                        </div>
                        <?= form_error('poin', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jt_bulan">JT BULAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="jt_bulan" id="jt_bulan" class="custom-select">
                                <option value="" selected disabled>PILIH JATUH TEMPO BULAN</option>
                                <?php
                                for($i=12; $i>=0; $i-=1){
                                echo"<option value='$i'> $i </option>";}
                                ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('jt_bulan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jt_hari">JT HARI</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="jt_hari" id="jt_hari" class="custom-select">
                                <option value="" selected disabled>PILIH JATUH TEMPO HARI</option>
                                <?php
                                for($i=30; $i>=0; $i-=1){
                                echo"<option value='$i'> $i </option>";}
                                ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('jt_hari', '<small class="text-danger">', '</small>'); ?>
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