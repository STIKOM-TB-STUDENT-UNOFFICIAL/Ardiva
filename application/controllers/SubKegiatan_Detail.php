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
        $this->load->model('Tahun_akademik_model');
        $this->load->database();
    }

    private function check_access($prodi_data)
    {
        $user_prodi = $this->session->userdata('kode_prodi');

        if ($user_prodi == 'UV') return true;
        if ($prodi_data == 'UV') return false;
        return $user_prodi == $prodi_data;
    }

    private function get_prodi_detail($idsubdetail)
    {
        $row = $this->db
            ->select('sd.kode_prodi')
            ->from('subkegiatan_detail sd')
            ->where('sd.idsubkegiatan_detail', $idsubdetail)
            ->get()->row();

        return $row ? $row->kode_prodi : null;
    }

    private function get_tahun_akademik()
    {
        $user_prodi = $this->session->userdata('kode_prodi');
        $this->Tahun_akademik_model->cek_default($user_prodi);
        return $this->Tahun_akademik_model->get_aktif($user_prodi)->tahun;
    }

    public function index($offset = null)
    {
        $kode_prodi = $this->session->userdata('kode_prodi');
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

        $config['base_url'] = base_url('sub-kegiatan-detail/page');
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
            $instrumen,
            $kode_prodi
        );

        $is_uv = ($kode_prodi == 'UV');
        if ($is_uv) {
            foreach ($data['list'] as $s) {
                $s->namasubkegiatan = $s->kode_prodi . " - " . $s->namasubkegiatan;
            }
        }

        $data["user_prodi"] = $this->session->userdata('kode_prodi');

        $this->db->select('subkegiatan.*, kegiatan.kegiatan AS nama_kegiatan');
        $this->db->from('subkegiatan');
        $this->db->join('kegiatan', 'kegiatan.idkegiatan = subkegiatan.idkegiatan', 'left');

        $data['subkegiatan'] = $this->db->get()->result();
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

    public function store()
    {
        $user_prodi = $this->session->userdata('kode_prodi');

        if ($user_prodi != 'UV') {
            $idSub = $this->input->post('idsubkegiatan');
            $prodiSub = $this->db->get_where('subkegiatan', ['idsubkegiatan' => $idSub])->row()->kode_prodi;

            if ($prodiSub != $user_prodi) {
                $this->session->set_flashdata('error', 'Anda tidak memiliki izin menambah sub kegiatan detail ini.');
                redirect('sub-kegiatan-detail');
            }
        }

        $insertData = [
            'idsubkegiatan' => $this->input->post('idsubkegiatan'),
            'namasubkegiatan_detail' => $this->input->post('namasubkegiatan_detail'),
            'kode_prodi' => $user_prodi
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
        $prodiData = $this->get_prodi_detail($id);

        if (!$this->check_access($prodiData)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin mengubah data UV.');
            redirect('sub-kegiatan-detail');
        }

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
        $prodiData = $this->get_prodi_detail($id);

        if (!$this->check_access($prodiData)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin menghapus data UV.');
            redirect('sub-kegiatan-detail');
        }

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
        $idsubdetail = $this->input->post('idsubkegiatan_detail');
        $prodiData = $this->get_prodi_detail($idsubdetail);

        if (!$this->check_access($prodiData)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin menambah file pada data UV.');
            redirect('sub-kegiatan-detail/' . $idsubdetail);
        }

        $tahun = $this->get_tahun_akademik();

        $dataInsert = [
            'idsubkegiatan_detail' => $this->input->post('idsubkegiatan_detail'),
            'jenis' => $this->input->post('jenis'),
            'topik' => $this->input->post('topik'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tanggal' => $this->input->post('tanggal'),
            'thnakademik' => $tahun,
            'kode_prodi' => $this->session->userdata('kode_prodi')
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
                    'file' => $filedata,
                    'kode_prodi' => $this->session->userdata('kode_prodi')
                ];

                $this->M_file_detail_model->insert($dataDetail);
            }
        }

        redirect('sub-kegiatan-detail/' . $this->input->post('idsubkegiatan_detail'));
    }

    public function update_file($idfile)
    {
        $file = $this->M_file_model->get_by_id($idfile);
        $prodiData = $this->get_prodi_detail($file->idsubkegiatan_detail);

        if (!$this->check_access($prodiData)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin mengubah file UV.');
            redirect('sub-kegiatan-detail/' . $file->idsubkegiatan_detail);
        }

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
        $prodiData = $this->get_prodi_detail($file->idsubkegiatan_detail);

        if (!$this->check_access($prodiData)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin menghapus file UV.');
            redirect('sub-kegiatan-detail/' . $file->idsubkegiatan_detail);
        }


        $this->M_file_detail_model->delete_by_master($idfile);
        $this->M_file_model->delete($idfile);

        redirect('sub-kegiatan-detail/' . $file->idsubkegiatan_detail);
    }
}
