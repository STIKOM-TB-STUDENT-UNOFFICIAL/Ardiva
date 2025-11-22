<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_file_detail_model extends CI_Model {

    public function get_by_file($id_m_file) {
        $this->db->where('id_m_file', $id_m_file);
        return $this->db->get('m_file_detail')->result();
    }

    public function get_by_file_prodi($id_m_file, $kode_prodi) {
        $this->db->where('id_m_file', $id_m_file);

        $this->db->group_start();
        $this->db->where('kode_prodi', $kode_prodi);
        $this->db->or_where('kode_prodi', 'UV');
        $this->db->group_end();

        return $this->db->get('m_file_detail')->result();
    }

    public function get_detail($id_file_detail) {
        return $this->db->get_where('m_file_detail', ['id_file_detail' => $id_file_detail])->row();
    }

    public function insert($data) {
        return $this->db->insert('m_file_detail', $data);
    }

    public function insert_batch($rows) {
        return $this->db->insert_batch('m_file_detail', $rows);
    }

    public function update($id_file_detail, $data) {
        $this->db->where('id_file_detail', $id_file_detail);
        return $this->db->update('m_file_detail', $data);
    }

    public function delete_by_master($id_m_file) {
        $this->db->where('id_m_file', $id_m_file);
        return $this->db->delete('m_file_detail');
    }

    public function delete($id_file_detail) {
        $this->db->where('id_file_detail', $id_file_detail);
        return $this->db->delete('m_file_detail');
    }
}
