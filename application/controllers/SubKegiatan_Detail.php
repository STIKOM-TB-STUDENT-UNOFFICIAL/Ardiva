<?php
#[AllowDynamicProperties]
class Subkegiatan_detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Subkegiatan_detail_model');
        $this->load->model('M_file_model');
        $this->load->model('M_file_detail_model');
        $this->load->database();
    }

    private function get_tahun_akademik()
    {
        $cek = $this->db->get('tahun_akademik')->num_rows();

        if ($cek == 0) {
            $tahun = date('Y') . "/" . (date('Y') + 1);
            $this->db->insert('tahun_akademik', ['tahun' => $tahun]);
        }

        $row = $this->db->get('tahun_akademik')->row();
        return $row->tahun;
    }

    public function index($offset = null)
    {
        if ($this->uri->segment(3) == null) {
            redirect("/sub-kegiatan-detail/page/0");
        }

        $offset = (int) ($this->uri->segment(3) ?? 0);

        if ($offset < 0) {
            $offset = 0;
        }

        $q = $this->input->get('q');
        $instrumen = $this->input->get('instrumen');

        $this->load->library('pagination');

        $config['base_url'] = site_url('sub-kegiatan-detail/page');
        $config['total_rows'] = $this->Subkegiatan_detail_model->count_all();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';

        $config['suffix'] = '?' . http_build_query($_GET);
        $config['first_url'] = $config['base_url'] . '/0?' . http_build_query($_GET);

        $this->pagination->initialize($config);

        $data['list'] = $this->Subkegiatan_detail_model->get_all(
            $config['per_page'],
            $offset,
            $q,
            $instrumen
        );

        $data['subkegiatan'] = $this->db->get('subkegiatan')->result();
        $data['instrumen']   = $this->db->get('instrumen')->result();
        $data['offset'] = $offset + 1;
        $data['pagination'] = $this->pagination->create_links();

        $data['filter_q']   = $q;
        $data['filter_instrumen'] = $instrumen;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('subkegiatan_detail', $data);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
        $data['detail'] = $this->Subkegiatan_detail_model->get_by_id($id);
        $data['instrumen'] = $this->Subkegiatan_detail_model->get_instrumen_by_detail($id);
        $data['files'] = $this->M_file_model->get_by_subdetail($id);
        $data['tahun_akademik'] = $this->get_tahun_akademik();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('show', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['subkegiatan'] = $this->db->get('subkegiatan')->result();
        $data['instrumen']   = $this->db->get('instrumen')->result();
        $this->load->view('subkegiatan_detail/create', $data);
    }

    public function store()
    {
        $insertData = [
            'idsubkegiatan' => $this->input->post('idsubkegiatan'),
            'namasubkegiatan_detail' => $this->input->post('namasubkegiatan_detail'),
        ];

        $idSubDetail = $this->Subkegiatan_detail_model->insert($insertData);

        if ($this->input->post('instrumen')) {
            $this->Subkegiatan_detail_model
                ->insert_instrumen($idSubDetail, $this->input->post('instrumen'));
        }

        redirect('sub-kegiatan-detail');
    }

    public function edit($id)
    {
        $data['detail']     = $this->Subkegiatan_detail_model->get_by_id($id);
        $data['subkegiatan'] = $this->db->get('subkegiatan')->result();
        $data['instrumen']  = $this->db->get('instrumen')->result();

        $selected = $this->Subkegiatan_detail_model->get_instrumen_by_detail($id);
        $data['selected_instrumen'] = array_column($selected, 'idinstrumen');

        echo json_encode($data);
    }

    public function update($id)
    {
        $updateData = [
            'idsubkegiatan'         => $this->input->post('idsubkegiatan'),
            'namasubkegiatan_detail' => $this->input->post('namasubkegiatan_detail')
        ];

        $this->Subkegiatan_detail_model->update($id, $updateData);

        $this->Subkegiatan_detail_model->delete_instrumen($id);

        if ($this->input->post('instrumen')) {
            $this->Subkegiatan_detail_model
                ->insert_instrumen($id, $this->input->post('instrumen'));
        }

        redirect('sub-kegiatan-detail');
    }

    public function delete($id)
    {
        $this->db->trans_start();
        
        $this->Subkegiatan_detail_model->delete_file_detail_by_sub($id);
        $this->Subkegiatan_detail_model->delete_file_by_sub($id);
        $this->Subkegiatan_detail_model->delete_instrumen($id);
        $this->Subkegiatan_detail_model->delete($id);

        $this->db->trans_complete();

        redirect('sub-kegiatan-detail');
    }

    public function store_file()
    {
        $tahun = $this->get_tahun_akademik();

        $dataInsert = [
            'idsubkegiatan_detail' => $this->input->post('idsubkegiatan_detail'),
            'jenis' => $this->input->post('jenis'),
            'topik' => $this->input->post('topik'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tanggal' => $this->input->post('tanggal'),
            'thnakademik' => $tahun
        ];

        $id_m_file = $this->M_file_model->insert($dataInsert);

        if (!empty($_FILES['file']['name'][0])) {

            $fileCount = count($_FILES['file']['name']);

            for ($i = 0; $i < $fileCount; $i++) {

                $filename = $_FILES['file']['name'][$i];
                $filedata = file_get_contents($_FILES['file']['tmp_name'][$i]);

                $dataDetail = [
                    'id_m_file' => $id_m_file,
                    'filename' => $filename,
                    'file' => $filedata
                ];

                $this->M_file_detail_model->insert($dataDetail);
            }
        }

        redirect('sub-kegiatan-detail/' . $this->input->post('idsubkegiatan_detail'));
    }

    public function update_file($idfile)
    {
        $file = $this->M_file_model->get_by_id($idfile);
        $dataUpdate = [
            'jenis' => $this->input->post('jenis'),
            'topik' => $this->input->post('topik'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tanggal' => $this->input->post('tanggal'),
        ];
        $this->M_file_model->update($idfile, $dataUpdate);

        redirect('sub-kegiatan-detail/' . $file->idsubkegiatan_detail);
    }

    public function delete_file($idfile)
    {
        $file = $this->M_file_model->get_by_id($idfile);
        $this->M_file_detail_model->delete_by_master($idfile);
        $this->M_file_model->delete($idfile);

        redirect('sub-kegiatan-detail/' . $file->idsubkegiatan_detail);
    }
}
