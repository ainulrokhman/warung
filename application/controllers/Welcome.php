<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	protected $MENU_NAME = "Dashboard";
	public function index()
	{
		$this->load->model('Model_Menu');
		$data['menu'] = $this->Model_Menu->get_all()->num_rows();
		$data['menu_name'] = $this->MENU_NAME;
		template_view('welcome_message', $data);
	}
}
