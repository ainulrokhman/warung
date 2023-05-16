<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    protected $MENU_NAME = "Daftar Kategori";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelKategori');
    }

    public function index()
    {
        $data['kategori'] = $this->ModelKategori->get_all()->result();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('kategori/index', $data);
    }

    public function hapus($id)
    {
        $hapus = $this->ModelKategori->delete($id);
        $alert = $this->load->view('utils/alert', ['status' => $hapus, "msg" => "Data berhasil dihapus"], true);
        $this->session->set_flashdata('notify', $alert);
        redirect(base_url('kategori'));
    }

    public function tambah()
    {
        if ($this->input->method() == "post") {
            $nama = $this->input->post('nama', true);
            $data = ['nama' => $nama];
            $insert = $this->ModelKategori->add($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil ditambahkan"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('kategori'));
            return;
        }

        $data['menu_name'] = $this->MENU_NAME;
        template_view('kategori/tambah', $data);
    }

    public function ubah($id)
    {
        if ($this->input->method() == "post") {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('nama', true);
            $data = ['nama' => $nama, 'id' => $id];
            $insert = $this->ModelKategori->update($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil diubah"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('kategori'));
            return;
        }
        $data = $this->ModelKategori->get_by_id($id)->row_array();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('kategori/ubah', $data);
    }
}
