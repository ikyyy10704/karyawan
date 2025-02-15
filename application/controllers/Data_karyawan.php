<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_karyawan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Data_karyawan_model');
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
    }

    public function index() {
        $data['title'] = 'Data Karyawan';
        $data['karyawan'] = $this->Data_karyawan_model->get_all_karyawan();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('data_karyawan/index', $data);
        $this->load->view('template/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Data Karyawan';
        $data['next_id'] = $this->Data_karyawan_model->get_next_id();

        $this->form_validation->set_rules('nama_krywn', 'Nama Karyawan', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Aktif,Tidak Aktif]');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required|in_list[Manager,Supervisor,Staff,Admin,Teknisi,Marketing,Operator]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/footer');
            $this->load->view('data_karyawan/create', $data);
        } else {
            $post_data = $this->input->post();
            $post_data['id_krywn'] = $data['next_id'];
            
            if ($this->Data_karyawan_model->create_karyawan($post_data)) {
                $this->session->set_flashdata('success', 'Data karyawan berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data karyawan');
            }
            redirect('data_karyawan');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Data Karyawan';
        $data['karyawan'] = $this->Data_karyawan_model->get_karyawan_by_id($id);

        if (!$data['karyawan']) {
            show_404();
        }

        $this->form_validation->set_rules('nama_krywn', 'Nama Karyawan', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Aktif,Tidak Aktif]');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required|in_list[Manager,Supervisor,Staff,Admin,Teknisi,Marketing,Operator]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/footer');
            $this->load->view('data_karyawan/edit', $data);
        } else {
            $post_data = $this->input->post();
            
            if ($this->Data_karyawan_model->update_karyawan($id, $post_data)) {
                $this->session->set_flashdata('success', 'Data karyawan berhasil diperbarui');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data karyawan');
            }
            redirect('data_karyawan');
        }
    }

    public function delete($id) {
        if (!$this->Data_karyawan_model->get_karyawan_by_id($id)) {
            show_404();
        }

        if ($this->Data_karyawan_model->delete_karyawan($id)) {
            $this->session->set_flashdata('success', 'Data karyawan berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data karyawan');
        }
        redirect('data_karyawan');
    }
}