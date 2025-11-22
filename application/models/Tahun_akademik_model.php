<?php
class Tahun_akademik_model extends CI_Model {
    public function generate_tahun() {
        $tahun_sekarang = date('Y');
        $tahun_mulai = $tahun_sekarang - 10;
        $tahun_akhir = $tahun_sekarang + 10;

        $list = [];

        for ($i = $tahun_mulai; $i <= $tahun_akhir; $i++) {
            $list[] = $i . "/" . ($i + 1);
        }

        return $list;
    }

    public function cek_default($kode_prodi) {
        $cek = $this->db
            ->where('kode_prodi', $kode_prodi)
            ->get('tahun_akademik')
            ->num_rows();

        if ($cek == 0) {
            $tahun = date('Y') . "/" . (date('Y') + 1);
            $this->db->insert('tahun_akademik', [
                'tahun'      => $tahun,
                'kode_prodi' => $kode_prodi
            ]);
        }
    }

    public function get_aktif($kode_prodi) {
        return $this->db
            ->where('kode_prodi', $kode_prodi)
            ->get('tahun_akademik')
            ->row();
    }

    public function update_tahun($kode_prodi, $tahun_baru) {
        $this->db
            ->where('kode_prodi', $kode_prodi)
            ->update('tahun_akademik', [
                'tahun' => $tahun_baru
            ]);
    }
}
