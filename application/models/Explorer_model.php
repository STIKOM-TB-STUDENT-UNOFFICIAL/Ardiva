<?php
class Explorer_model extends CI_Model
{
    private $kode_prodi;

    public function __construct()
    {
        parent::__construct();
        
        $this->kode_prodi = $this->session->userdata('kode_prodi');
    }

    private function filterProdi($table)
    {
        if ($this->kode_prodi == 'UV') {
            return;
        }
        
        $this->db->group_start();
        $this->db->where("$table.kode_prodi", $this->kode_prodi);
        $this->db->or_where("$table.kode_prodi", "UV");
        $this->db->group_end();
    }

    public function getKegiatan()
    {
        $this->filterProdi('kegiatan');
        return $this->db->get('kegiatan')->result();
    }

    public function getSubKegiatan($idkegiatan)
    {
        $this->db->where('idkegiatan', $idkegiatan);
        $this->filterProdi('subkegiatan');
        return $this->db->get('subkegiatan')->result();
    }

    public function getSubKegiatanDetail($idsub)
    {
        $this->db->where('idsubkegiatan', $idsub);
        $this->filterProdi('subkegiatan_detail');
        return $this->db->get('subkegiatan_detail')->result();
    }

    public function getFile($idDetail)
    {
        $this->db->where('idsubkegiatan_detail', $idDetail);
        $this->filterProdi('m_file');
        return $this->db->get('m_file')->result();
    }

    public function getFileDetail($idFile)
    {
        $this->db->select('id_file_detail, filename');
        $this->db->where('id_m_file', $idFile);
        $this->filterProdi('m_file_detail');
        return $this->db->get('m_file_detail')->result();
    }

    public function getSingleFile($id)
    {
        $this->db->where('id_file_detail', $id);
        $this->filterProdi('m_file_detail');
        return $this->db->get('m_file_detail')->row();
    }
}
