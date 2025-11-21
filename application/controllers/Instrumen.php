<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Instrumen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Instrumen_model');
    }

    public function index()
    {
        $data['instrumen'] = $this->Instrumen_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('instrumen', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->view('instrumen/create');
    }

    public function store()
    {
        $data = [
            'namainstrumen' => $this->input->post('namainstrumen'),
            'tahun'         => $this->input->post('tahun')
        ];

        $this->Instrumen_model->insert($data);
        redirect('instrumen');
    }

    public function edit($id)
    {
        $data = $this->Instrumen_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update($id)
    {
        $data = [
            'namainstrumen' => $this->input->post('namainstrumen'),
            'tahun'         => $this->input->post('tahun')
        ];

        $this->Instrumen_model->update($id, $data);
        redirect('instrumen');
    }

    public function delete($id)
    {
        $this->Instrumen_model->delete($id);
        redirect('instrumen');
    }
}
