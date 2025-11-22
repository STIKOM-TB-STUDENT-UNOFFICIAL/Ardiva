<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_model extends CI_Model {
    private $table = 'kegiatan';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getByProdi($kode_prodi, $is_uv)
    {
        if ($is_uv) {
            $this->db->select('kegiatan.*, prodi.kode_prodi');
            $this->db->from('kegiatan');
            $this->db->join('prodi', 'prodi.kode_prodi = kegiatan.kode_prodi', 'left');
            return $this->db->get()->result();
        }

        $this->db->where("(kode_prodi = '$kode_prodi' OR kode_prodi = 'UV')");
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['idkegiatan' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('idkegiatan', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['idkegiatan' => $id]);
    }
}
