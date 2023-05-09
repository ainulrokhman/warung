<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Menu');
        $this->load->model('Model_Kategori');
    }

    public function index()
    {
        $data['menu'] = $this->Model_Menu->get_all()->result();
        template_view('menu/index', $data);
    }

    public function hapus($id)
    {
        $hapus = $this->Model_Menu->delete($id);
        $alert = $this->load->view('utils/alert', ['status' => $hapus, "action" => "hapus"], true);
        $this->session->set_flashdata('notify', $alert);
        redirect(base_url('menu'));
    }

    public function tambah()
    {
        if ($this->input->method() == "post") {
            $nama = $this->input->post('nama', true);
            $kategori = $this->input->post('kategori', true);
            $stok = $this->input->post('stok', true);
            $harga = $this->input->post('harga', true);
            $data = [
                'nama' => $nama,
                'kategori_id' => $kategori,
                'stok' => $stok,
                'harga' => $harga,
            ];
            // echo json_encode($data);
            $insert = $this->Model_Menu->add($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "action" => "tambahkan"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('menu'));
            return;
        }
        $data['kategori'] = $this->Model_Kategori->get_all()->result();
        template_view('menu/tambah', $data);
    }

    public function ubah($id)
    {
        if ($this->input->method() == "post") {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('nama', true);
            $kategori = $this->input->post('kategori', true);
            $stok = $this->input->post('stok', true);
            $harga = $this->input->post('harga', true);
            $data = [
                'id' => $id,
                'nama' => $nama,
                'kategori_id' => $kategori,
                'stok' => $stok,
                'harga' => $harga,
            ];
            $insert = $this->Model_Menu->update($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "action" => "ubah"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('menu'));
            return;
        }
        $data = $this->Model_Menu->get_by_id($id)->row_array();
        $data['kategori'] = $this->Model_Kategori->get_all()->result();
        template_view('menu/ubah', $data);
    }
}
