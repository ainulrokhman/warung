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
            echo json_encode($this->input->post());
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
