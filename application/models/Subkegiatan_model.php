<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subkegiatan_model extends CI_Model {

    private $table = 'subkegiatan';

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

    public function get_kegiatan() {
        return $this->db->get('kegiatan')->result();
    }
}
