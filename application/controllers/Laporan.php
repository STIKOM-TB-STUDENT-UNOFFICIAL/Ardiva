<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Laporan_model');
    }


    public function index() {
        $keyword    = $this->input->get('q');
        $idinstrumen = $this->input->get('instrumen');
        $jenis       = $this->input->get('jenis');

        $data['filters'] = [
            'keyword' => $keyword,
            'idinstrumen' => $idinstrumen,
            'jenis' => $jenis
        ];

        $data['list'] = $this->Laporan_model->getFiltered($keyword, $idinstrumen, $jenis);
        $data['instrumen'] = $this->db->get('instrumen')->result();
        $data['jenis_list'] = $this->db->select('jenis')->group_by('jenis')->get('m_file')->result();
        $data['filter_q']   = $keyword;
        $data['filter_instrumen'] = $idinstrumen;
        $data['filter_jenis'] = $jenis;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        //print_r(json_encode($data["list"]));
        $this->load->view('laporan', $data);
        $this->load->view('templates/footer');
    }
}
