<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Kategori');
    }

    public function index()
    {
        $data['kategori'] = $this->Model_Kategori->get_all()->result();
        template_view('kategori/index', $data);
    }

    public function hapus($id)
    {
        $hapus = $this->Model_Kategori->delete($id);
        $alert = $this->load->view('utils/alert', ['status' => $hapus, "action" => "hapus"], true);
        $this->session->set_flashdata('notify', $alert);
        redirect(base_url('kategori'));
    }

    public function tambah()
    {
        if ($this->input->method() == "post") {
            $nama = $this->input->post('nama', true);
            $data = ['nama' => $nama];
            $insert = $this->Model_Kategori->add($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "action" => "tambahkan"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('kategori'));
            return;
        }
        template_view('kategori/tambah');
    }

    public function ubah($id)
    {
        if ($this->input->method() == "post") {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('nama', true);
            $data = ['nama' => $nama, 'id' => $id];
            $insert = $this->Model_Kategori->update($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "action" => "ubah"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('kategori'));
            return;
        }
        $data = $this->Model_Kategori->get_by_id($id)->row_array();
        template_view('kategori/ubah', $data);
    }
}
