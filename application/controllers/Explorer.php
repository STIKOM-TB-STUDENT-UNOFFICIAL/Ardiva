<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Explorer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Explorer_model');
    }

    public function index() {
        $data['kegiatan'] = $this->Explorer_model->getKegiatan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('rekapitulasi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function subkegiatan($idkegiatan) {
        echo json_encode($this->Explorer_model->getSubKegiatan($idkegiatan));
    }

    public function subkegiatandetail($idsub) {
        echo json_encode($this->Explorer_model->getSubKegiatanDetail($idsub));
    }

    public function file($idDetail) {
        echo json_encode($this->Explorer_model->getFile($idDetail));
    }

    public function file_detail($idFile) {
        echo json_encode($this->Explorer_model->getFileDetail($idFile));
    }

    public function open_file($id_file_detail) {
        $file = $this->Explorer_model->getSingleFile($id_file_detail);

        $filename = $file->filename;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array(strtolower($ext), ['png','jpg','jpeg','gif','pdf'])) {
            header("Content-type: application/pdf");
            echo $file->file;
        } else {
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            echo $file->file;
        }
    }
}
