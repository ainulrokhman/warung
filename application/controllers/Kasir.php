<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    protected $MENU_NAME = "Kasir";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Kategori');
        $this->load->model('Model_Menu');
    }
    public function index()
    {
        if ($this->input->method() == "post") {
            $pembeli = $this->input->post('pembeli', true);
            $nama = $this->input->post('nama', true);
            $hp = $this->input->post('hp', true);
            $alamat = $this->input->post('alamat', true);
            $id = $this->input->post('id', true);
            $qty = $this->input->post('qty', true);
            $total = $this->input->post('total', true);
            $bayar = $this->input->post('bayar', true);
            $kembali = $this->input->post('kembali', true);

            $data = [
                "pembeli" => $pembeli,
                "nama" => $nama,
                "hp" => $hp,
                "alamat" => $alamat,
                "total" => $total,
                "bayar" => $bayar,
                "kembali" => $kembali,
            ];
            for ($i = 0; $i < sizeof($id); $i++) {
                $data['pesanan'][] = [
                    'id' => $id[$i],
                    'qty' => $qty[$i],
                ];
            }

            echo json_encode($data);
            return;
        }
        $data['menu_name'] = $this->MENU_NAME;
        $data['menu'] = $this->Model_Menu->get_all()->result();
        template_view('kasir/index', $data);
    }
    public function menu()
    {

        if ($this->input->method() == "post") {
            $id = $this->input->post('id', true);
            $data = $this->Model_Menu->get_by_id($id)->row_array();
            $html = $this->load->view('utils/kasir_menu', $data, true);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['nama'])));
            $result = [
                "data" => $data,
                'html' => $html,
                'slug' => $slug
            ];
            echo json_encode($result);
        }
    }
}
