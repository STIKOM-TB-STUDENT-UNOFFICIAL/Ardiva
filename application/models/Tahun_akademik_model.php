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

    public function cek_default() {
        $cek = $this->db->get('tahun_akademik')->num_rows();

        if ($cek == 0) {
            $tahun = date('Y') . "/" . (date('Y') + 1);
            $this->db->insert('tahun_akademik', ['tahun' => $tahun]);
        }
    }

    public function get_aktif() {
        return $this->db->get('tahun_akademik')->row();
    }

    public function update_tahun($tahun_baru) {
        $this->db->update('tahun_akademik', ['tahun' => $tahun_baru]);
    }
}
