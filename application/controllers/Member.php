<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    protected $MENU_NAME = "Daftar Member";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelMember');
    }

    public function index()
    {
        $data['kategori'] = $this->ModelMember->get_all()->result();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('member/index', $data);
    }

    public function hapus($id)
    {
        $hapus = $this->ModelMember->delete($id);
        $alert = $this->load->view('utils/alert', ['status' => $hapus, "msg" => "Data berhasil dihapus"], true);
        $this->session->set_flashdata('notify', $alert);
        redirect(base_url('member'));
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
            $insert = $this->ModelMember->add($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil ditambahkan"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('member'));
            return;
        }

        $data['menu_name'] = $this->MENU_NAME;
        template_view('member/tambah', $data);
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
            $insert = $this->ModelMember->update($data);
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => "Data berhasil diubah"], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('member'));
            return;
        }
        $data = $this->ModelMember->get_by_id($id)->row_array();
        $data['menu_name'] = $this->MENU_NAME;
        template_view('member/ubah', $data);
    }
}
