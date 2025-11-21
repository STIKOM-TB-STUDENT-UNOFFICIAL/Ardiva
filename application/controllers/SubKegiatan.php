<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[AllowDynamicProperties]
class Subkegiatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Subkegiatan_model');
    }

    public function index()
    {   
        $data['subkegiatan'] = $this->Subkegiatan_model->get_all();
        $data['kegiatan'] = $this->Subkegiatan_model->get_kegiatan();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('subkegiatan', $data);
        $this->load->view('templates/footer');
    }


    public function store()
    {
        $data = [
            'idkegiatan' => $this->input->post('idkegiatan'),
            'namasubkegiatan' => $this->input->post('namasubkegiatan')
        ];

        $this->Subkegiatan_model->insert($data);
        redirect('sub-kegiatan');
    }

    public function edit($id)
    {
        $data = $this->Subkegiatan_model->get_by_id($id);
        echo json_encode($data);
    }


    public function update($id)
    {
        $data = [
            'idkegiatan' => $this->input->post('idkegiatan'),
            'namasubkegiatan' => $this->input->post('namasubkegiatan')
        ];

        $this->Subkegiatan_model->update($id, $data);
        redirect('sub-kegiatan');
    }

    public function delete($id)
    {
        $this->Subkegiatan_model->delete($id);
        redirect('sub-kegiatan');
    }
}
