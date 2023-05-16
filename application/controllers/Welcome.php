<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	protected $MENU_NAME = "Dashboard";
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
		$data['menu'] = $this->ModelMenu->get_all()->num_rows();
		$data['member'] = $this->ModelMember->get_all()->num_rows();
		$data['transaksi'] = $this->ModelTransaksi->get_all()->num_rows();
		$data['menu_name'] = $this->MENU_NAME;
		template_view('welcome_message', $data);
	}
}
