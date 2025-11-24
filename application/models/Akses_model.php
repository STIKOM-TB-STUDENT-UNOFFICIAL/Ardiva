<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_model extends CI_Model {

    private $table = 'login_system';

    public function getAll()
    {
        $this->db->select("$this->table.*, hak_akses.kode_prodi, prodi.nama_prodi");
        $this->db->from("$this->table");
        $this->db->join("hak_akses", "hak_akses.userid = $this->table.userid", "left");
        $this->db->join("prodi", "prodi.kode_prodi = hak_akses.kode_prodi", "left");
        $this->db->order_by("$this->table.nama_lengkap", "ASC");

        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function getById($userid)
    {
        return $this->db->get_where($this->table, ['userid' => $userid])->row();
    }

    public function update($userid, $data)
    {
        $this->db->where('userid', $userid);
        return $this->db->update($this->table, $data);
    }

    public function delete($userid)
    {
        return $this->db->delete($this->table, ['userid' => $userid]);
    }
}
