<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    protected $MENU_NAME = "Daftar Menu";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelMenu');
        $this->load->model('ModelKategori');
    }

    public function index()
    {
        $data['menu'] = $this->ModelMenu->get_all()->result();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('menu/index', $data);
    }

    public function hapus($id)
    {
        $hapus = $this->ModelMenu->delete($id);
        $alert = $this->load->view('utils/alert', ['status' => $hapus, "msg" => "Data berhasil dihapus"], true);
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
            $insert = $this->ModelMenu->add($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil ditambahkan"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('menu'));
            return;
        }
        $data['kategori'] = $this->ModelKategori->get_all()->result();
        $data['menu_name'] = $this->MENU_NAME;
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
            $insert = $this->ModelMenu->update($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil diubah"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('menu'));
            return;
        }
        $data = $this->ModelMenu->get_by_id($id)->row_array();
        $data['kategori'] = $this->ModelKategori->get_all()->result();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('menu/ubah', $data);
    }
}
