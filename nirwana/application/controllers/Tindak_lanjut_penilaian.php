<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tindak_lanjut_penilaian extends CI_Controller
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
        $data['title'] = "TINDAK LANJUT PENILAIAN";
        $data['supplier'] = $this->admin->get('supplier');
        
        $data['user'] = $this->admin->get('user');
        $data['ref_jenis_penilaian'] = $this->admin->get('ref_jenis_penilaian');
        $data['join'] = $this->admin->join('supplier', 'ref_jenis_penilaian', 'supplier.jns_penilaian=ref_jenis_penilaian.jenis_penilaian')->result_array();
        
        //$data['join'] = $this->admin->get('supplier');
        $this->template->load('templates/dashboard', 'tindak_lanjut_penilaian/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nm_objek_pn', 'Nama Objek', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "TAMBAH DATA TINDAK LANJUT PENILAIAN";
            $this->template->load('templates/dashboard', 'tindak_lanjut_penilaian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('supplier', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('tindak_lanjut_penilaian');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('tindak_lanjut_penilaian/add');
            }
        }
    }


    public function edit($getId)
    {
        $data['ref_pejabat_penilaian'] = $this->admin->get('ref_pejabat_penilaian');
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "TINDAK LANJUT PENILAIAN";
            $data['supplier'] = $this->admin->get('supplier', ['id_supplier' => $id]);

            // Get values for conditions
            $nosprint = $data['supplier']['no_sprint'];
            $nolaporan = $data['supplier']['nomor_laporan'];

            // Update the status based on conditions
            $statususulan = $this->admin->updateStatusUsulan($nosprint, $nolaporan);
            $data['supplier']['status_usulan'] = $statususulan;

            // Load the view
            $this->template->load('templates/dashboard', 'tindak_lanjut_penilaian/edit', $data);
        } else {
            // Assuming $id, $noSprint, and $noLaporan are available from your form data
            $input = $this->input->post(null, true);

            // Update the 'status_usulan' and the 'supplier' data
            $config['upload_path'] = './public/upload_laporan';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10240; // 10MB
            $config['encrypt_name'] = TRUE; // Rename uploaded file

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('surat_laporan')) {
                // Jika upload berhasil, ambil data file yang diunggah
                $upload_data = $this->upload->data();
                // Simpan nama file ke dalam $input['surat_laporan']
                $input['surat_laporan'] = $upload_data['file_name'];
            } else {
                // Jika upload gagal, simpan pesan error atau lakukan penanganan lainnya
                $input['surat_laporan'] = '';
                $error = $this->upload->display_errors();
                // Handle error sesuai kebutuhan
            }

            $nosprint = $input['no_sprint'];
            $nolaporan = $input['nomor_laporan'];;
            $statususulan = $this->admin->updateStatusUsulan($nosprint, $nolaporan);
            $input['status_usulan'] = 'PROSES';
            if($input['nomor_laporan']){
                $input['status_usulan'] = 'SELESAI';
            };

            $update = $this->admin->update('supplier', 'id_supplier', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('tindak_lanjut_penilaian');
            } else {
                set_pesan('data gagal diedit.');
                redirect('tindak_lanjut_penilaian/edit/' . $id);
            }
        }

    }
    public function revisi($getId)
    {
        $data['ref_pejabat_penilaian'] = $this->admin->get('ref_pejabat_penilaian');
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "TINDAK LANJUT PENILAIAN";
            $data['supplier'] = $this->admin->get('supplier', ['id_supplier' => $id]);

            // Get values for conditions
            $nosprint = $data['supplier']['no_sprint'];
            $nolaporan = $data['supplier']['nomor_laporan'];

            // Update the status based on conditions
            $statususulan = $this->admin->updateStatusUsulan($nosprint, $nolaporan);
            $data['supplier']['status_usulan'] = $statususulan;

            // Load the view
            $this->template->load('templates/dashboard', 'tindak_lanjut_penilaian/revisi', $data);
        } else {
            // Assuming $id, $noSprint, and $noLaporan are available from your form data
            $input = $this->input->post(null, true);

            // Update the 'status_usulan' and the 'supplier' data
            $nosprint = $input['no_sprint'];
            $nolaporan = $input['nomor_laporan'];;
            $statususulan = $this->admin->updateStatusUsulan($nosprint, $nolaporan);
            $input['status_usulan'] = 'PROSES';
            if($input['nomor_laporan']){
                $input['status_usulan'] = 'SELESAI';
            };

            $update = $this->admin->update('supplier', 'id_supplier', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('tindak_lanjut_penilaian');
            } else {
                set_pesan('data gagal diedit.');
                redirect('tindak_lanjut_penilaian/edit/' . $id);
            }
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
        redirect('tindak_lanjut_penilaian');
    }

}
