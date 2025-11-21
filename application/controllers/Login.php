<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Login extends CI_Controller {

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('kegiatan');
        }

        $this->load->view('auth_login');
    }

    public function proses()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($username == 'admin' && $password == '123') {
            $this->session->set_userdata('logged_in', TRUE);
            redirect('kegiatan');
        } else {
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}