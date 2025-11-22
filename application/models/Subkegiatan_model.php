<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subkegiatan_model extends CI_Model {

    private $table = 'subkegiatan';

    public function get_by_prodi($kode_prodi, $is_uv)
    {
        $this->db->select('subkegiatan.*, kegiatan.kegiatan, kegiatan.kode_prodi AS kode_kegiatan_prodi');
        $this->db->from($this->table);
        $this->db->join('kegiatan', 'kegiatan.idkegiatan = subkegiatan.idkegiatan', 'left');

        if (!$is_uv) {
            $this->db->where("(subkegiatan.kode_prodi = '$kode_prodi' OR subkegiatan.kode_prodi = 'UV')");
        }

        return $this->db->get()->result();
    }

    public function get_all() {
        $this->db->select('subkegiatan.*, kegiatan.kegiatan');
        $this->db->from($this->table);
        $this->db->join('kegiatan', 'kegiatan.idkegiatan = subkegiatan.idkegiatan', 'left');
        $this->db->order_by('subkegiatan.idsubkegiatan', 'ASC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['idsubkegiatan' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('idsubkegiatan', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('idsubkegiatan', $id);
        return $this->db->delete($this->table);
    }

    public function get_kegiatan_by_prodi($kode_prodi, $is_uv)
    {
        if ($is_uv) {
            return $this->db->get('kegiatan')->result();
        }

        $this->db->where("(kode_prodi = '$kode_prodi' OR kode_prodi = 'UV')");
        return $this->db->get('kegiatan')->result();
    }

    public function get_all_kegiatan(){
        return $this->db->get('kegiatan')->result();
    }
}
