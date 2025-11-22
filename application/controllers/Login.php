<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('kegiatan');
        }

        $this->load->view('auth_login');
    }

    public function proses()
    {
        $username = $this->input->post('username', TRUE);
        $password = md5($this->input->post('password', TRUE));

        $user = $this->db->get_where('login_system', [
            'userid' => $username,
            'password' => $password,
            'blokir' => 'N'
        ])->row();

        if ($user) {
            $this->db->select('hak_akses.*, prodi.nama_prodi');
            $this->db->from('hak_akses');
            $this->db->join('prodi', 'prodi.kode_prodi = hak_akses.kode_prodi', 'left');
            $this->db->where('hak_akses.userid', $user->userid);
            $akses = $this->db->get()->row();

            $kode_prodi = $akses ? $akses->kode_prodi : null;
            $nama_prodi = $akses ? $akses->nama_prodi : null;

            $this->session->set_userdata([
                'logged_in'     => TRUE,
                'userid'        => $user->userid,
                'nama_lengkap'  => $user->nama_lengkap,
                'level'         => $user->level,
                'kode_prodi'   => $kode_prodi,
                'nama_prodi'   => $nama_prodi
            ]);

            $this->db->where('userid', $user->userid)
                     ->update('login_system', [
                        'last_login' => date('Y-m-d H:i:s')
                     ]);

            redirect('kegiatan');

        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
