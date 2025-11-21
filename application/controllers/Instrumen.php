<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Instrumen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Instrumen_model');
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

        $data['instrumen'] = $this->Instrumen_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('instrumen', $data);
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
            'namainstrumen' => $this->input->post('namainstrumen'),
            'tahun'         => $this->input->post('tahun')
        ];

        $this->Instrumen_model->insert($data);
        redirect('instrumen');
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

        $data = $this->Instrumen_model->get_by_id($id);
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
            'namainstrumen' => $this->input->post('namainstrumen'),
            'tahun'         => $this->input->post('tahun')
        ];

        $this->Instrumen_model->update($id, $data);
        redirect('instrumen');
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
        
        $this->Instrumen_model->delete($id);
        redirect('instrumen');
    }
}
