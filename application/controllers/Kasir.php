<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    protected $MENU_NAME = "Kasir";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelKategori');
        $this->load->model('ModelMenu');
        $this->load->model('ModelTransaksi');
        $this->load->model('ModelDetailTransaksi');
        $this->load->model('ModelMember');
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
            $kembali = getNumberFromRupiah("Rp $bayar") - getNumberFromRupiah($total);

            $data['transaksi'] = [
                "invoice" => generateInvoice(),
                "total" => getNumberFromRupiah($total),
                "bayar" => getNumberFromRupiah("Rp $bayar"),
                "kembali" => $kembali,
            ];

            if ($pembeli > 0) {
                $data['transaksi']['id_member'] = $pembeli;
            } elseif ($pembeli == 0) {
                $data['member']['nama'] = $nama;
                $data['member']['hp'] = $hp;
                $data['member']['alamat'] = $alamat;
                $data['transaksi']['id_member'] = $this->ModelMember->add($data['member']);
            }

            $id_transaksi = $this->ModelTransaksi->add($data['transaksi']);

            for ($i = 0; $i < sizeof($id); $i++) {
                $menu = $this->ModelMenu->get_by_id($id[$i])->row_array();
                $data['detail_transaksi'][$i]['id_transaksi'] = $id_transaksi;
                $data['detail_transaksi'][$i]['nama_menu'] = $menu['nama'];
                $data['detail_transaksi'][$i]['harga'] = $menu['harga'];
                $data['detail_transaksi'][$i]['qty'] = $qty[$i];
            }

            $insert = $this->ModelDetailTransaksi->add($data['detail_transaksi']);
            $msg = 'Transaksi tersimpan <a href="#"><i class="fas fa-print text-danger"></i> Print</a>';
            $alert = $this->load->view('utils/alert', ['status' => $insert, "msg" => $msg], true);
            $this->session->set_flashdata('notify', $alert);
            redirect(base_url('kasir'));
            return;
        }

        $data['menu_name'] = $this->MENU_NAME;
        $data['menu'] = $this->ModelMenu->get_all()->result();
        template_view('kasir/index', $data);
    }
    public function menu()
    {

        if ($this->input->method() == "post") {
            $id = $this->input->post('id', true);
            $data = $this->ModelMenu->get_by_id($id)->row_array();
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
