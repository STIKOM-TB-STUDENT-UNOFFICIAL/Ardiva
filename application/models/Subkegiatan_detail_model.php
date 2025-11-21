<?php
class Subkegiatan_detail_model extends CI_Model
{
    public function get_all($limit, $offset, $q = null, $instrumen = null)
    {
        $this->db->select('sd.*, s.namasubkegiatan');
        $this->db->from('subkegiatan_detail sd');
        $this->db->join('subkegiatan s', 's.idsubkegiatan = sd.idsubkegiatan');

        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('s.namasubkegiatan', $q);
            $this->db->or_like('sd.namasubkegiatan_detail', $q);
            $this->db->group_end();
        }

        if (!empty($instrumen)) {
            $this->db->join('insub_detail ins', 'ins.idsubkegiatan_detail = sd.idsubkegiatan_detail');
            $this->db->where('ins.idinstrumen', $instrumen);
        }

        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }


    public function count_all($q = null, $instrumen = null)
    {
        $this->db->from('subkegiatan_detail sd');
        $this->db->join('subkegiatan s', 's.idsubkegiatan = sd.idsubkegiatan');

        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('s.namasubkegiatan', $q);
            $this->db->or_like('sd.namasubkegiatan_detail', $q);
            $this->db->group_end();
        }

        if (!empty($instrumen)) {
            $this->db->join('insub_detail ins', 'ins.idsubkegiatan_detail = sd.idsubkegiatan_detail');
            $this->db->where('ins.idinstrumen', $instrumen);
        }

        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->select('sd.*, s.namasubkegiatan');
        $this->db->from('subkegiatan_detail sd');
        $this->db->join('subkegiatan s', 's.idsubkegiatan = sd.idsubkegiatan');
        $this->db->where('idsubkegiatan_detail', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        $this->db->insert('subkegiatan_detail', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('idsubkegiatan_detail', $id);
        return $this->db->update('subkegiatan_detail', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('subkegiatan_detail', ['idsubkegiatan_detail' => $id]);
    }

    public function delete_instrumen($id)
    {
        return $this->db->delete('insub_detail', ['idsubkegiatan_detail' => $id]);
    }

    public function delete_file_by_sub($id)
    {
        return $this->db->delete('m_file', ['idsubkegiatan_detail' => $id]);
    }

    public function delete_file_detail_by_sub($id)
    {
        $files = $this->db->get_where('m_file', [
            'idsubkegiatan_detail' => $id
        ])->result();

        foreach ($files as $f) {
            $this->db->delete('m_file_detail', ['id_m_file' => $f->idfile]);
        }
    }

    public function get_instrumen_by_detail($id)
    {
        $this->db->select('i.idinstrumen, i.namainstrumen');
        $this->db->from('insub_detail ind');
        $this->db->join('instrumen i', 'i.idinstrumen = ind.idinstrumen');
        $this->db->where('ind.idsubkegiatan_detail', $id);
        return $this->db->get()->result();
    }

    public function insert_instrumen($idsub_detail, $instrumen)
    {
        foreach ($instrumen as $i) {
            $this->db->insert('insub_detail', [
                'idsubkegiatan_detail' => $idsub_detail,
                'idinstrumen'          => $i
            ]);
        }
    }
}
