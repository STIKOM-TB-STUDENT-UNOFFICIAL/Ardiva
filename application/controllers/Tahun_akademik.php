<?php
#[AllowDynamicProperties]
class Tahun_akademik extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Tahun_akademik_model');
    }

    public function index() {
        $level = $this->session->userdata('level');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }

        $this->Tahun_akademik_model->cek_default();
        $data['tahun_list'] = $this->Tahun_akademik_model->generate_tahun();
        $data['tahun_aktif'] = $this->Tahun_akademik_model->get_aktif();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('tahun_akademik', $data);
        $this->load->view('templates/footer');
    }

    public function update() {
        $level = $this->session->userdata('level');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }
        
        $tahun = $this->input->post('tahun_akademik');
        $this->Tahun_akademik_model->update_tahun($tahun);
        redirect('tahun-akademik');
    }
}
