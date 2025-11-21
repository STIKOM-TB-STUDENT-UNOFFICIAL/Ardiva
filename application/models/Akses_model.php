<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_model extends CI_Model {

    private $table = 'login_system';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
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
