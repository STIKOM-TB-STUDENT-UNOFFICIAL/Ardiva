<?php
class Explorer_model extends CI_Model
{

    public function getKegiatan()
    {
        return $this->db->get('kegiatan')->result();
    }

    public function getSubKegiatan($idkegiatan)
    {
        return $this->db->get_where('subkegiatan', ['idkegiatan' => $idkegiatan])->result();
    }

    public function getSubKegiatanDetail($idsub)
    {
        return $this->db->get_where('subkegiatan_detail', ['idsubkegiatan' => $idsub])->result();
    }

    public function getFile($idDetail)
    {
        return $this->db->get_where('m_file', ['idsubkegiatan_detail' => $idDetail])->result();
    }

    public function getFileDetail($idFile)
    {
        $this->db->select('id_file_detail, filename');
        return $this->db->get_where('m_file_detail', ['id_m_file' => $idFile])->result();
    }

    public function getSingleFile($id)
    {
        return $this->db->get_where('m_file_detail', ['id_file_detail' => $id])->row();
    }
}
