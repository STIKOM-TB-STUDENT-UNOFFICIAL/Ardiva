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
        $kode_prodi = $this->session->userdata('kode_prodi');
        $is_uv = ($kode_prodi == 'UV');

        $data['subkegiatan'] = $this->Subkegiatan_model->get_by_prodi($kode_prodi, $is_uv);
        $data['kegiatan'] = $this->Subkegiatan_model->get_kegiatan_by_prodi($kode_prodi, $is_uv);
        $data["kode_prodi"] = $kode_prodi;

        if ($is_uv) {
            foreach ($data['subkegiatan'] as $s) {
                $s->namasubkegiatan = $s->kode_prodi . " - " . $s->namasubkegiatan;
                $s->kegiatan = $s->kode_prodi . " - " . $s->kegiatan;
            }
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('subkegiatan', $data);
        $this->load->view('templates/footer');
    }


    public function store()
    {
        $kode_prodi = $this->session->userdata('kode_prodi');

        if ($kode_prodi != 'UV') {
            $idkegiatan = $this->input->post('idkegiatan');
            $prodi = $this->db->get_where('kegiatan', ['idkegiatan' => $idkegiatan])->row()->kode_prodi;

            if ($prodi == 'UV') {
                $this->session->set_flashdata('error', 'Anda tidak boleh membuat kegiatan Universal.');
                redirect('sub-kegiatan');
            }
        }

        $data = [
            'idkegiatan' => $this->input->post('idkegiatan'),
            'namasubkegiatan' => $this->input->post('namasubkegiatan'),
            'kode_prodi'       => $kode_prodi
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
        $kode_prodi = $this->session->userdata('kode_prodi');
        $s = $this->Subkegiatan_model->get_by_id($id)->idkegiatan;
        $kegiatan = $this->db->get_where('kegiatan', ['idkegiatan' => $s])->row();

        if ($kegiatan->kode_prodi == 'UV' && $kode_prodi != 'UV') {
            $this->session->set_flashdata('error', 'Anda tidak boleh mengubah subkegiatan Universal.');
            redirect('sub-kegiatan');
            return;
        }

        $data = [
            'idkegiatan' => $this->input->post('idkegiatan'),
            'namasubkegiatan' => $this->input->post('namasubkegiatan'),
            'kode_prodi'      => $kegiatan->kode_prodi
        ];

        $this->Subkegiatan_model->update($id, $data);
        redirect('sub-kegiatan');
    }

    public function delete($id)
    {
        $kode_prodi = $this->session->userdata('kode_prodi');
        $s = $this->Subkegiatan_model->get_by_id($id);

        if ($s->kode_prodi == 'UV' && $kode_prodi != 'UV') {
            $this->session->set_flashdata('error', 'Anda tidak boleh menghapus subkegiatan Universal.');
            redirect('sub-kegiatan');
            return;
        }

        $this->Subkegiatan_model->delete($id);
        redirect('sub-kegiatan');
    }
}
