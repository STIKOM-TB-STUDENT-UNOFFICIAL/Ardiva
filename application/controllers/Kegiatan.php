<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Kegiatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Kegiatan_model');
    }

    public function index()
    {
        $level = $this->session->userdata('level');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }
        
        $data['kegiatan'] = $this->Kegiatan_model->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kegiatan', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $level = $this->session->userdata('level');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'kegiatan' => $this->input->post('kegiatan')
        ];

        $this->Kegiatan_model->insert($data);

        redirect('kegiatan');
    }

    public function edit($id)
    {
        $level = $this->session->userdata('level');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }

        $data = $this->Kegiatan_model->getById($id);
        echo json_encode($data);
    }

    public function update($id)
    {
        $level = $this->session->userdata('level');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'kegiatan' => $this->input->post('kegiatan')
        ];

        $this->Kegiatan_model->update($id, $data);

        redirect('kegiatan');
    }

    public function delete($id)
    {
        $level = $this->session->userdata('level');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }
        
        $this->Kegiatan_model->delete($id);
        redirect('kegiatan');
    }
}