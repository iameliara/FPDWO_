<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_pejabat_penilaian extends CI_Controller
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
        $data['title'] = "PEJABAT PENILAI";
        $data['ref_pejabat_penilaian'] = $this->admin->get('ref_pejabat_penilaian');
        $data['user'] = $this->admin->get('user');
        $this->template->load('templates/dashboard', 'ref/ref_pejabat_penilaian/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nip9', 'NIP9', 'required|min_length[9]|max_length[9]');
        $this->form_validation->set_rules('pejabat_penilai', 'Pejabat Penilaian', 'required');
    }

    public function add()
    {
        $data['ref_pejabat_penilaian'] = $this->admin->get('ref_pejabat_penilaian');
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "TAMBAH DATA PEJABAT PENILAI";
            $this->template->load('templates/dashboard', 'ref/ref_pejabat_penilaian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('ref_pejabat_penilaian', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('ref/ref_pejabat_penilaian');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('ref/ref_pejabat_penilaian/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "EDIT DATA PENILAIAN";
            $data['ref_pejabat_penilaian'] = $this->admin->get('ref_pejabat_penilaian', ['id' => $id]);
            $this->template->load('templates/dashboard', 'ref/ref_pejabat_penilaian/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('ref_pejabat_penilaian', 'id', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('ref/ref_pejabat_penilaian');
            } else {
                set_pesan('data gagal diedit.');
                redirect('ref/ref_pejabat_penilaian/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('ref_pejabat_penilaian', 'id', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('ref/ref_pejabat_penilaian');
    }
}
