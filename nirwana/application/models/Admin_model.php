<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getUsers($id)
    {
        /**
         * ID disini adalah untuk data yang tidak ingin ditampilkan. 
         * Maksud saya disini adalah 
         * tidak ingin menampilkan data user yang digunakan, 
         * pada managemen data user
         */
        $this->db->where('id_user !=', $id);
        return $this->db->get('user')->result_array();
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function sum($table, $field)
    {
        $this->db->select_sum($field);
        return $this->db->get($table)->row_array()[$field];
    }

    public function min($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }

    public function chartBarangMasuk($bulan)
    {
        $like = 'T-BM-' . date('y') . $bulan;
        $this->db->like('id_barang_masuk', $like, 'after');
        return count($this->db->get('barang_masuk')->result_array());
    }

    public function chartBarangKeluar($bulan)
    {
        $like = 'T-BK-' . date('y') . $bulan;
        $this->db->like('id_barang_keluar', $like, 'after');
        return count($this->db->get('barang_keluar')->result_array());
    }

    public function laporan($table, $mulai, $akhir)
    {
        $tgl = $table == 'barang_masuk' ? 'tanggal_masuk' : 'tanggal_keluar';
        $this->db->where($tgl . ' >=', $mulai);
        $this->db->where($tgl . ' <=', $akhir);
        return $this->db->get($table)->result_array();
    }

    public function cekStok($id)
    {
        $this->db->join('satuan s', 'b.satuan_id=s.id_satuan');
        return $this->db->get_where('barang b', ['id_barang' => $id])->row_array();
    }

        public function join($table,$tbljoin,$join)
    {
        $this->db->join($tbljoin,$join);
        return $this->db->get($table);

    }

        public function usulan_penilaian()
    {
        $this->db->join($tbljoin,$join);
        return $this->db->get($table);

    }

    public function updateStatusUsulan($nosprint, $nolaporan)
    {
        $data = array();
        if (empty(trim($nosprint)) && empty(trim($nolaporan))) {
            // If both NO S-PRINT and NO LAPORAN are empty, set STATUS TINDAK LANJUT to 'BELUM'
            $data['status_usulan'] = 'BELUM';
        } elseif (!empty(trim($nosprint)) && empty(!trim($nolaporan))) {
            // If NO S-PRINT is filled but NO LAPORAN is empty, set STATUS TINDAK LANJUT to 'PROSES'
            $data['status_usulan'] = 'PROSES';
        } elseif (!empty(trim($nosprint)) && !empty(trim($nolaporan))) {
            // If both NO S-PRINT and NO LAPORAN are filled, set STATUS TINDAK LANJUT to 'SELESAI'
            $data['status_usulan'] = 'SELESAI';
        } else {
            // Default case, if none of the above conditions match
            $data['status_usulan'] = 'UNKNOWN';
        }


        // Update the database with the new STATUS TINDAK LANJUT value
        return $data['status_usulan'];
    }
    public function get_suppliers($is_admin, $username) {
        if (!$is_admin) {
            $this->db->where('perekam', $username);
        }
        
        $this->db->select('supplier.*, ref_jenis_penilaian.*');
        $this->db->from('supplier');
        $this->db->join('ref_jenis_penilaian', 'supplier.jns_penilaian = ref_jenis_penilaian.jenis_penilaian');
        
        $query = $this->db->get();
        return $query->result_array();
    }

}
