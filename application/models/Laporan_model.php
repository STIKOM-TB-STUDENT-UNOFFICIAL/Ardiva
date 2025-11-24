<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function getFiltered($keyword = null, $idinstrumen = null, $jenis = null)
    {
        // Ambil Kode Prodi dari Session
        $kode_prodi = $this->session->userdata('kode_prodi');

        // ---------------------------------------------------------------
        // LANGKAH 1: AMBIL DATA FILE & DETAILNYA (FILTER BERLAKU DI SINI)
        // ---------------------------------------------------------------
        $this->db->select('m_file.*, m_file_detail.id_file_detail, m_file_detail.filename');
        $this->db->from('m_file');
        $this->db->join('m_file_detail', 'm_file_detail.id_m_file = m_file.idfile', 'left');

        // 1. Filter Hak Akses Prodi untuk FILE
        if ($kode_prodi != 'UV') {
            $this->db->group_start();
            $this->db->where('m_file.kode_prodi', $kode_prodi);
            $this->db->or_where('m_file.kode_prodi', 'UV');
            $this->db->group_end();
        }

        // Filter Keyword
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('m_file.topik', $keyword);
            $this->db->or_like('m_file.deskripsi', $keyword);
            $this->db->or_like('m_file.jenis', $keyword);
            $this->db->group_end();
        }

        // Filter Jenis
        if (!empty($jenis)) {
            $this->db->where('m_file.jenis', $jenis);
        }

        $raw_files = $this->db->get()->result();

        // Mapping Files
        $mapped_files = [];
        foreach ($raw_files as $row) {
            if (!isset($mapped_files[$row->idsubkegiatan_detail])) {
                $mapped_files[$row->idsubkegiatan_detail] = [];
            }
            $mapped_files[$row->idsubkegiatan_detail][] = $row;
        }

        // ---------------------------------------------------------------
        // LANGKAH 2: BANGUN STRUKTUR HIERARKI (KEGIATAN > SUB > DETAIL)
        // ---------------------------------------------------------------

        // 2. Filter Hak Akses Prodi untuk KEGIATAN
        if ($kode_prodi != 'UV') {
            $this->db->group_start();
            $this->db->where('kode_prodi', $kode_prodi);
            $this->db->or_where('kode_prodi', 'UV');
            $this->db->group_end();
        }

        // Ambil Semua Kegiatan
        $kegiatan = $this->db->get('kegiatan')->result();

        foreach ($kegiatan as &$k) {

            // LOGIKA KHUSUS USER UV: Ubah Nama Kegiatan
            if ($kode_prodi == 'UV') {
                $k->kegiatan = "[" . $k->kode_prodi . "] - " . $k->kegiatan;
            }

            // 3. Filter Hak Akses Prodi untuk SUB KEGIATAN
            // (Kita terapkan juga di sini agar hierarki konsisten)
            $this->db->where('idkegiatan', $k->idkegiatan);
            if ($kode_prodi != 'UV') {
                $this->db->group_start();
                $this->db->where('kode_prodi', $kode_prodi);
                $this->db->or_where('kode_prodi', 'UV');
                $this->db->group_end();
            }
            $k->subkegiatan = $this->db->get('subkegiatan')->result();

            foreach ($k->subkegiatan as &$s) {

                // Ambil Detail milik Sub Kegiatan ini
                $this->db->select('subkegiatan_detail.*');
                $this->db->from('subkegiatan_detail');

                // Filter Instrumen
                if (!empty($idinstrumen)) {
                    $this->db->join('insub_detail', 'insub_detail.idsubkegiatan_detail = subkegiatan_detail.idsubkegiatan_detail');
                    $this->db->where('insub_detail.idinstrumen', $idinstrumen);
                }

                // 4. Filter Hak Akses Prodi untuk DETAIL
                if ($kode_prodi != 'UV') {
                    $this->db->group_start();
                    $this->db->where('subkegiatan_detail.kode_prodi', $kode_prodi);
                    $this->db->or_where('subkegiatan_detail.kode_prodi', 'UV');
                    $this->db->group_end();
                }

                $this->db->where('subkegiatan_detail.idsubkegiatan', $s->idsubkegiatan);
                $s->detail = $this->db->get()->result();

                foreach ($s->detail as &$d) {
                    $d->files_grouped = []; // Default kosong

                    // Cek apakah detail ini punya file dari hasil Langkah 1?
                    if (isset($mapped_files[$d->idsubkegiatan_detail])) {

                        // Proses Grouping File berdasarkan Jenis
                        foreach ($mapped_files[$d->idsubkegiatan_detail] as $f_row) {
                            $jenis_key = $f_row->jenis;

                            if (!isset($d->files_grouped[$jenis_key])) {
                                $d->files_grouped[$jenis_key] = [
                                    'jenis' => $jenis_key,
                                    'files' => []
                                ];
                            }

                            // Merapikan struktur file header dan detail
                            $file_header_exists = false;
                            foreach ($d->files_grouped[$jenis_key]['files'] as &$existing_file) {
                                if ($existing_file['file_header']->idfile == $f_row->idfile) {
                                    if ($f_row->id_file_detail) {
                                        $existing_file['file_detail'][] = (object)[
                                            'id_file_detail' => $f_row->id_file_detail,
                                            'filename' => $f_row->filename
                                        ];
                                    }
                                    $file_header_exists = true;
                                    break;
                                }
                            }

                            if (!$file_header_exists) {
                                $new_file_entry = [
                                    'file_header' => (object)[
                                        'idfile' => $f_row->idfile,
                                        'topik' => $f_row->topik,
                                        'deskripsi' => $f_row->deskripsi,
                                        'jenis' => $f_row->jenis
                                    ],
                                    'file_detail' => []
                                ];

                                if ($f_row->id_file_detail) {
                                    $new_file_entry['file_detail'][] = (object)[
                                        'id_file_detail' => $f_row->id_file_detail,
                                        'filename' => $f_row->filename
                                    ];
                                }

                                $d->files_grouped[$jenis_key]['files'][] = $new_file_entry;
                            }
                        }
                    }
                }
            }
        }

        return $kegiatan;
    }
}
