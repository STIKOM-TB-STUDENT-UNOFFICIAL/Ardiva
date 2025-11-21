<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class FileDetail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Subkegiatan_detail_model');
        $this->load->model('M_file_detail_model');
        $this->load->model('M_file_model');
        $this->load->database();
    }

    public function index($idsub, $idfile)
    {
        $data['filemaster'] = $this->M_file_model->get_by_id($idfile);
        if (!$data['filemaster']) {
            show_404();
        }

        $data['detail_list'] = $this->M_file_detail_model->get_by_file($idfile);
        $data['idsub'] = $idsub;
        $data['idfile'] = $idfile;
        $data['detail'] = $this->Subkegiatan_detail_model->get_by_id($idsub);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('file_detail_list', $data);
        $this->load->view('templates/footer');
    }

    public function store($idsub, $idfile)
    {
        $master = $this->M_file_model->get_by_id($idfile);
        if (!$master) {
            show_404();
        }

        if (!empty($_FILES['file']['name'][0])) {
            $rows = [];
            $count = count($_FILES['file']['name']);
            for ($i=0; $i < $count; $i++) {
                if (is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
                    $filename = $_FILES['file']['name'][$i];
                    $filedata = file_get_contents($_FILES['file']['tmp_name'][$i]);

                    $rows[] = [
                        'id_m_file' => $idfile,
                        'filename'  => $filename,
                        'file'      => $filedata
                    ];
                }
            }

            if (!empty($rows)) {
                $this->M_file_detail_model->insert_batch($rows);
            }
        }

        redirect('sub-kegiatan-detail/'.$idsub.'/files/'.$idfile);
    }

    public function update($id_file_detail)
    {
        $detail = $this->M_file_detail_model->get_detail($id_file_detail);
        if (!$detail) {
            show_404();
        }

        $update = [];

        if (!empty($_FILES['file_replace']['name'])) {
            if (is_uploaded_file($_FILES['file_replace']['tmp_name'])) {
                $update['filename'] = $_FILES['file_replace']['name'];
                $update['file'] = file_get_contents($_FILES['file_replace']['tmp_name']);
            }
        }

        if ($this->input->post('filename')) {
            $update['filename'] = $this->input->post('filename');
        }

        if (!empty($update)) {
            $this->M_file_detail_model->update($id_file_detail, $update);
        }

        $master = $this->M_file_model->get_by_id($detail->id_m_file);
        redirect('sub-kegiatan-detail/'.$master->idsubkegiatan_detail.'/files/'.$master->idfile);
    }

    public function delete($id_file_detail)
    {
        $detail = $this->M_file_detail_model->get_detail($id_file_detail);
        if (!$detail) {
            show_404();
        }

        $master = $this->M_file_model->get_by_id($detail->id_m_file);
        $idsub = $master ? $master->idsubkegiatan_detail : '';

        $this->M_file_detail_model->delete($id_file_detail);

        redirect('sub-kegiatan-detail/'.$idsub.'/files/'.$master->idfile);
    }

    public function view($id_file_detail)
    {
        $file = $this->M_file_detail_model->get_detail($id_file_detail);
        if (!$file) {
            show_404();
        }

        $ext = strtolower(pathinfo($file->filename, PATHINFO_EXTENSION));

        if (in_array($ext, ['pdf','jpg','jpeg','png'])) {

            $ctype = 'application/octet-stream';
            if ($ext === 'pdf') $ctype = 'application/pdf';
            if (in_array($ext, ['jpg','jpeg'])) $ctype = 'image/jpeg';
            if ($ext === 'png') $ctype = 'image/png';

            header("Content-Type: {$ctype}");
            header("Content-Disposition: inline; filename=\"{$file->filename}\"");
            echo $file->file;
            return;
        }

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"{$file->filename}\"");
        echo $file->file;
    }
}
