<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    protected $MENU_NAME = "Daftar Transaksi";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelTransaksi');
        $this->load->model('ModelDetailTransaksi');
    }

    public function index()
    {
        if ($this->input->method() == "post") {
            $id = $this->input->post('id', true);
            $data = $this->ModelDetailTransaksi->get_by_id($id)->result();
            echo json_encode($data);
            return;
        }
        $data['kategori'] = $this->ModelTransaksi->get_all()->result();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('transaksi/index', $data);
    }

    public function hapus($id)
    {
        $hapus = $this->ModelTransaksi->delete($id);
        $alert = $this->load->view('utils/alert', ['status' => $hapus, "msg" => "Data berhasil dihapus"], true);
        $this->session->set_flashdata('notify', $alert);
        redirect(base_url('transaksi'));
    }

    public function tambah()
    {
        if ($this->input->method() == "post") {
            $nama = $this->input->post('nama', true);
            $hp = $this->input->post('hp', true);
            $alamat = $this->input->post('alamat', true);
            $data = [
                'nama' => $nama,
                'hp' => $hp,
                'alamat' => $alamat,
            ];
            $insert = $this->ModelTransaksi->add($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil ditambahkan"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('transaksi'));
            return;
        }

        $data['menu_name'] = $this->MENU_NAME;
        template_view('transaksi/tambah', $data);
    }

    public function ubah($id)
    {
        if ($this->input->method() == "post") {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('nama', true);
            $hp = $this->input->post('hp', true);
            $alamat = $this->input->post('alamat', true);
            $data = [
                'id' => $id,
                'nama' => $nama,
                'hp' => $hp,
                'alamat' => $alamat,
            ];
            $insert = $this->ModelTransaksi->update($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil diubah"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('transaksi'));
            return;
        }
        $data = $this->ModelTransaksi->get_by_id($id)->row_array();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('transaksi/ubah', $data);
    }
}
