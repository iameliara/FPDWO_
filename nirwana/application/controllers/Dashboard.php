<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        if ($this->session->userdata('login_session')['role'] != "admin") {
            $data['supplier'] = count($this->db->get_where("supplier",['perekam' => $this->session->userdata('login_session')['nama']])->result());
            $data['usulan_sudah'] = count($this->db->get_where("supplier",['perekam' => $this->session->userdata('login_session')['nama'],'status_usulan' => "SELESAI" ])->result());
            $data['usulan_ditolak'] = count($this->db->get_where("supplier",['perekam' => $this->session->userdata('login_session')['nama'],'status_usulan' => "DITOLAK" ])->result());
            $data['usulan_belum'] = count($this->db->get_where("supplier",['perekam' => $this->session->userdata('login_session')['nama'],'status_usulan' => "BELUM" ])->result());
            $data['usulan_proses'] = count($this->db->get_where("supplier",['perekam' => $this->session->userdata('login_session')['nama'],'status_usulan' => "PROSES" ])->result());


        }else{
            $data['supplier'] = $this->admin->count('supplier');
            $data['usulan_sudah'] = $this->db->from("supplier")->where('status_usulan', 'SELESAI')->count_all_results();
            $data['usulan_ditolak'] = $this->db->from("supplier")->where('status_usulan', 'DITOLAK')->count_all_results();
            $data['usulan_belum'] = $this->db->from("supplier")->where('status_usulan', 'BELUM')->count_all_results();
            $data['usulan_proses'] = $this->db->from("supplier")->where('status_usulan', 'PROSES')->count_all_results();
        }
        $data['user'] = $this->admin->count('user');

        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
