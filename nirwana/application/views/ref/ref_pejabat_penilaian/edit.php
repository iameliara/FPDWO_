<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Data Pejabat Penilaian
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('ref/ref_pejabat_penilaian') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id' => $ref_pejabat_penilaian['id']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="objek_penilaian">NAMA OBJEK PENILAIAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('nip9', $ref_pejabat_penilaian['nip9']); ?>" name="nip9" id="nip9" type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()"></input>
                        </div>
                        <?= form_error('nip9', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="pejabat_penilai">NAMA OBJEK PENILAIAN</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <input value="<?= set_value('pejabat_penilai', $ref_pejabat_penilaian['pejabat_penilai']); ?>" name="pejabat_penilai" id="pejabat_penilai" type="text" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase()"></input>
                        </div>
                        <?= form_error('pejabat_penilai', '<small class="text-danger">', '</small>'); ?>
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