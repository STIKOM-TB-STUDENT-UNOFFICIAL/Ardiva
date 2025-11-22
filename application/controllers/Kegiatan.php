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
        $kode_prodi = $this->session->userdata('kode_prodi');

        if ($level == 'mahasiswa') {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('no_access');
            $this->load->view('templates/footer');
            return;
        }

        $is_uv = ($kode_prodi == 'UV');
        $data['kegiatan'] = $this->Kegiatan_model->getByProdi($kode_prodi, $is_uv);

        if ($is_uv) {
            foreach ($data['kegiatan'] as $k) {
                $k->kegiatan = $k->kode_prodi . " - " . $k->kegiatan;
            }
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kegiatan', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $kode_prodi = $this->session->userdata('kode_prodi');

        if ($kode_prodi != 'UV') {
            if ($this->input->post('kode_prodi') == 'UV') {
                $this->session->set_flashdata('error', 'Anda tidak boleh membuat kegiatan Universal.');
                redirect('kegiatan');
            }
        }

        $data = [
            'kegiatan'   => $this->input->post('kegiatan'),
            'kode_prodi' => $kode_prodi
        ];

        $this->Kegiatan_model->insert($data);
        redirect('kegiatan');
    }

    public function edit($id)
    {
        $k = $this->Kegiatan_model->getById($id);

        echo json_encode($k);
    }

    public function update($id)
    {
        $kode_prodi = $this->session->userdata('kode_prodi');
        $k = $this->Kegiatan_model->getById($id);

        if ($k->kode_prodi == 'UV' && $kode_prodi != 'UV') {
            $this->session->set_flashdata('error', 'Anda tidak boleh mengubah kegiatan Universal.');
            redirect('kegiatan');
            return;
        }

        if ($kode_prodi != 'UV') {
            if ($this->input->post('kode_prodi') == 'UV') {
                $this->session->set_flashdata('error', 'Anda tidak boleh mengubah prodi kegiatan menjadi Universal.');
                redirect('kegiatan');
                return;
            }
        }

        $data = [
            'kegiatan' => $this->input->post('kegiatan'),
            'kode_prodi' => $k->kode_prodi
        ];

        $this->Kegiatan_model->update($id, $data);
        redirect('kegiatan');
    }

    public function delete($id)
    {
        $kode_prodi = $this->session->userdata('kode_prodi');
        $k = $this->Kegiatan_model->getById($id);

        if ($k->kode_prodi == 'UV' && $kode_prodi != 'UV') {
            $this->session->set_flashdata('error', 'Anda tidak boleh menghapus kegiatan Universal.');
            redirect('kegiatan');
            return;
        }

        $this->Kegiatan_model->delete($id);
        redirect('kegiatan');
    }
}
