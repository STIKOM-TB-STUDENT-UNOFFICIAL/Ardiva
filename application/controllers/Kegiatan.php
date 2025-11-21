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
        $data['kegiatan'] = $this->Kegiatan_model->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kegiatan', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->view('kegiatan/create');
    }

    public function store()
    {
        $data = [
            'kegiatan' => $this->input->post('kegiatan')
        ];

        $this->Kegiatan_model->insert($data);

        redirect('kegiatan');
    }

    public function edit($id)
    {
        $data = $this->Kegiatan_model->getById($id);
        echo json_encode($data);
    }

    public function update($id)
    {
        $data = [
            'kegiatan' => $this->input->post('kegiatan')
        ];

        $this->Kegiatan_model->update($id, $data);

        redirect('kegiatan');
    }

    public function delete($id)
    {
        $this->Kegiatan_model->delete($id);
        redirect('kegiatan');
    }
}