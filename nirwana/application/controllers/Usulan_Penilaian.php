<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usulan_penilaian extends CI_Controller
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
        $data['title'] = "USULAN PENILAIAN";
        $is_admin = ($this->session->userdata('login_session')['role'] == "admin");
        $username = $this->session->userdata('login_session')['nama'];

        $data['supplier'] = $this->admin->get_suppliers($is_admin, $username);

        // echo "<pre>";
        // print_r($data['supplier']);
        // echo "<pre>";
        $data['user'] = $this->admin->get('user');
        $this->template->load('templates/dashboard', 'usulan_penilaian/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nm_objek_pn', 'Nama Objek Penilaian', 'required|trim');
        $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim|numeric|min_length[15]|max_length[15]');
        $this->form_validation->set_rules('no_usulan', 'No. Usulan', 'required|trim');
        $this->form_validation->set_rules('tgl_usulan', 'Tanggal Usulan', 'required|trim');
        $this->form_validation->set_rules('jns_penilaian', 'Jenis Penilaian', 'required|trim');
        $this->form_validation->set_rules('objek_penilaian', 'Objek Penilaian', 'required|trim');
        $this->form_validation->set_rules('tahun_pajak', 'Tahun Pajak', 'required|trim');
        $this->form_validation->set_rules('poin', 'Poin', 'required|trim');
        $this->form_validation->set_rules('asal_usulan', 'Asal Usulan', 'required|trim');
    }

    public function add()
    {
        //$input = $this->input->post(null, true);

        // Cek apakah data dengan nama objek, jenis penilaian, dan tahun pajak yang sama sudah ada
        // $existing_data = $this->admin->get_where('usulan_penilaian', [
        //     'nama_objek' => $input['nama_objek'],
        //     'jenis_penilaian' => $input['jenis_penilaian'],
        //     'tahun_pajak' => $input['tahun_pajak']
        // ]);
    
        // if ($existing_data) {
        //     // Jika data sudah ada, tampilkan pesan alert dan redirect ke form add
        //     set_pesan('Data dengan nama objek, jenis penilaian, dan tahun pajak yang sama sudah ada. Apakah Anda ingin melanjutkan?', false);
        //     $this->session->set_flashdata('duplicate_data', $input); // Simpan data inputan sementara di session
        //     redirect('usulan_penilaian/confirm_add');
        // }
        $data['supplier'] = $this->admin->get('supplier');
        $data['ref_objek_penilaian'] = $this->admin->get('ref_objek_penilaian');
        $data['ref_jenis_penilaian'] = $this->admin->get('ref_jenis_penilaian');
        $data['ref_sumber_penilaian'] = $this->admin->get('ref_sumber_penilaian');

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "TAMBAH DATA PENILAIAN";
            $data['kpp'] = $this->session->userdata('login_session')['kpp'];
            $this->template->load('templates/dashboard', 'usulan_penilaian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('supplier', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('usulan_penilaian');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('usulan_penilaian/add');
            }
        }
    }


    public function edit($getId)
    {
        $data['supplier'] = $this->admin->get('supplier');
        $data['ref_objek_penilaian'] = $this->admin->get('ref_objek_penilaian');
        $data['ref_jenis_penilaian'] = $this->admin->get('ref_jenis_penilaian');
        $data['ref_sumber_penilaian'] = $this->admin->get('ref_sumber_penilaian');

        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "EDIT DATA PENILAIAN";
            $data['supplier'] = $this->admin->get('supplier', ['id_supplier' => $id]);
            $this->template->load('templates/dashboard', 'usulan_penilaian/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('supplier', 'id_supplier', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('usulan_penilaian');
            } else {
                set_pesan('data gagal diedit.');
                redirect('usulan_penilaian/edit/' . $id);
            }
        }
    }

    public function tolak($getId)
    {

        $id = encode_php_tags($getId);
        $input = ["status_usulan" => "DITOLAK", "keterangan" => $this->input->get("alasan", true)];
        $update = $this->admin->update('supplier', 'id_supplier', $id, $input);

        if ($update) {
            set_pesan('data berhasil ditolak.');
            redirect('tindak_lanjut_penilaian');
        } else {
            set_pesan('data gagal ditolak.');
            redirect('tindak_lanjut_penilaian');
        }
    }

    public function diterima($getId)
    {
        $id = encode_php_tags($getId);
        $input = ["status" => 1];
        $update = $this->admin->update('supplier', 'id_supplier', $id, $input);

        if ($update) {
            set_pesan('data berhasil ditolak.');
            redirect('usulan_penilaian');
        } else {
            set_pesan('data gagal ditolak.');
            redirect('usulan_penilaian');
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('supplier', 'id_supplier', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('usulan_penilaian');
    }
}
