<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Akses extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Akses_model');
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

        $data['level'] = $level;
        $data['users'] = $this->Akses_model->getAll();
        $data['prodi'] = $this->db->get('prodi')->result();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('akses', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $fotoBlob = null;

        if (!empty($_FILES['foto']['tmp_name'])) {
            $fotoBlob = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $data = [
            'userid'        => $this->input->post('userid'),
            'password'      => md5($this->input->post('password')),
            'nama_lengkap'  => $this->input->post('nama_lengkap'),
            'foto'          => $fotoBlob,
            'level'         => $this->input->post('level'),
            'blokir'        => 'N'
        ];

        $this->Akses_model->insert($data);
        $this->db->insert("hak_akses", [
            'userid' => $this->input->post('userid'),
            'kode_prodi' => $this->input->post('kode_prodi')
        ]);

        redirect('akses');
    }

    public function update()
    {
        $userid     = $this->input->post('userid');
        $nama       = $this->input->post('nama_lengkap');
        $password   = $this->input->post('password');
        $level      = $this->input->post('level');
        $blokir     = $this->input->post('blokir');

        $data = [
            'nama_lengkap' => $nama,
            'level'        => $level,
            'blokir'       => $blokir,
        ];

        if (!empty($password)) {
            $data['password'] = md5($password);
        }

        if (!empty($_FILES['foto']['tmp_name'])) {
            $data['foto'] = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $this->Akses_model->update($userid, $data);

        $hak_akses = $this->db->get_where('hak_akses', ['userid' => $userid])->row();

        if(!$hak_akses){
            $this->db->insert('hak_akses', ['userid' => $userid, 'kode_prodi' => $this->input->post('kode_prodi')]);
        }
        else{
            $this->db->where('userid', $userid);
            $this->db->update('hak_akses', ['kode_prodi' => $this->input->post('kode_prodi')]);
        }

        redirect('akses');
    }

    public function delete($userid)
    {
        $hak_akses = $this->db->get_where('hak_akses', ['userid' => $userid])->row();

        if($hak_akses){
            $this->db->where('userid', $userid);
            $this->db->delete('hak_akses');
        }

        $this->Akses_model->delete($userid);
        redirect('akses');
    }
}
