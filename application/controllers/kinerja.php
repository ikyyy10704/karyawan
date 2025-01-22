<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kinerja extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Kinerja_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'session']);
    }

    public function index() {
        $data['title'] = 'Data Kinerja Karyawan';
        $data['kinerja'] = $this->Kinerja_model->get_kinerja_karyawan(); 
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('kinerja/kinerja_list.php', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $data['title'] = 'Tambah Data Kinerja';
        $data['karyawan'] = $this->Kinerja_model->get_active_karyawan();
        $data['manajer1'] = $this->Kinerja_model->get_managers();
        $data['manajer'] = $this->Kinerja_model->get_all_manajer();
        

        $this->form_validation->set_rules('status_pengelolaan', 'Status Pengelolaan', 'required');
        $this->form_validation->set_rules('tgl_pengelolaan', 'Tanggal Pengelolaan', 'required');
        
        $data = array(
            'id_krywn' => $this->input->post('id_krywn'),
            'id_absensi' => $this->input->post('id_absensi'),
            'tgl_pengelolaan' => $this->input->post('tgl_pengelolaan'),
            'nilai_kerja' => $this->input->post('nilai_kerja'),
            'status_pengelolaan' => $this->input->post('status_pengelolaan'),
            'id_manajer' => $this->input->post('id_manajer')
        );
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
        $this->load->view('kinerja/kinerja_tambah', $data);
    }
    

    public function edit($id) {
     $this->form_validation->set_rules('status_pengelolaan', 'Status Pengelolaan', 'required');
    $this->form_validation->set_rules('tgl_pengelolaan', 'Tanggal Pengelolaan', 'required');
    $data = array(
        'nilai_kerja' => $this->input->post('nilai_kerja'),
        'status_pengelolaan' => $this->input->post('status_pengelolaan'),
        'tgl_pengelolaan' => $this->input->post('tgl_pengelolaan'),
        'id_manajer' => $this->input->post('id_manajer')
    );
        $data['title'] = 'Edit Data Kinerja';
        $data['kinerja'] = $this->Kinerja_model->get_kinerja_by_id($id);
        $data['manajer'] = $this->Kinerja_model->get_all_manajer();
        
        if (!$data['kinerja']) {
            $this->session->set_flashdata('error', 'Data kinerja tidak ditemukan');
            redirect('kinerja');
        }
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('kinerja/kinerja_edit', $data);
        $this->load->view('template/footer');
    }
    public function hapus($id) {
        if ($this->Kinerja_model->delete_kinerja($id)) {
            $this->session->set_flashdata('success', 'Data kinerja berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data kinerja. Pastikan tidak ada data terkait.');
        }
        redirect('kinerja');
    }
}