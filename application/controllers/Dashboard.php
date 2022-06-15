<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'dashboard', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/dashboard',
			'plugin' => 'plugins/default',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}
}
