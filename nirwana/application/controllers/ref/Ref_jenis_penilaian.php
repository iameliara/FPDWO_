<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_jenis_penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "JENIS PENILAIAN";
        $data['ref_jenis_penilaian'] = $this->admin->get('ref_jenis_penilaian');
        $data['user'] = $this->admin->get('user');
        $this->template->load('templates/dashboard', 'ref/ref_jenis_penilaian/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('jenis_penilaian', 'Nama Jenis Penilaian', 'required');
        $this->form_validation->set_rules('poin', 'Nilai poin', 'required');
        $this->form_validation->set_rules('jt_bulan', 'Jatuh Tempo Bulan Penilaian', 'required');
        $this->form_validation->set_rules('jt_hari', 'Jatuh Tempo Bulan Penilaian', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "TAMBAH DATA JENIS PENILAIAN";
            $this->template->load('templates/dashboard', 'ref/ref_jenis_penilaian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('ref_jenis_penilaian', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('ref/ref_jenis_penilaian');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('ref/ref_jenis_penilaian/add');
            }
        }
    }


    public function edit($getId)
    {
        $data['ref_jenis_penilaian'] = $this->admin->get('ref_jenis_penilaian');

        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "EDIT DATA PENILAIAN";
            $data['ref_jenis_penilaian'] = $this->admin->get('ref_jenis_penilaian', ['id' => $id]);
            $this->template->load('templates/dashboard', 'ref/ref_jenis_penilaian/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('ref_jenis_penilaian', 'id', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('ref/ref_jenis_penilaian');
            } else {
                set_pesan('data gagal diedit.');
                redirect('ref/ref_jenis_penilaian/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('ref_jenis_penilaian', 'id', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('ref/ref_jenis_penilaian');
    }
}
