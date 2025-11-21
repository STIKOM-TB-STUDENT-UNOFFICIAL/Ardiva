<?php
class M_file_model extends CI_Model {

    public function get_by_subdetail($idsub) {
        $this->db->where('idsubkegiatan_detail', $idsub);
        return $this->db->get('m_file')->result();
    }

    public function get_by_id($idfile) {
        return $this->db->get_where('m_file', ['idfile' => $idfile])->row();
    }

    public function insert($data) {
        $this->db->insert('m_file', $data);
        return $this->db->insert_id();
    }

    public function update($idfile, $data) {
        $this->db->where('idfile', $idfile);
        return $this->db->update('m_file', $data);
    }

    public function delete($idfile) {
        $this->db->where('idfile', $idfile);
        return $this->db->delete('m_file');
    }
}
