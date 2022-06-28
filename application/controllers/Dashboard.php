<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	var $bulan = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('money');
		$this->load->model('TransaksiModel');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'dashboard', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/dashboard',
			'plugin' => 'plugins/dashboard',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function count()
	{
		$this->load->model('UserModel');
		$data['transactionValue'] = $this->transactionValue();
		$data['totalOrder'] = $this->totalOrder();

		$user = $this->UserModel->countUser()->row();
		$data['total_customer'] = $user->total_customer;
		$data['total_fotografer'] = $user->total_fotografer;

		echo json_encode($data);
	}

	public function transactionValue()
	{
		$value = [];

		foreach ($this->bulan as $bl => $val) {
			$get = $this->TransaksiModel->GetTransactionValue($val);

			if ($get->num_rows() > 0) {
				$value[] = $get->row('trx_value');
			} else {
				$value[] = 0;
			}
		}

		return $value;
	}

	public function totalOrder()
	{
		$value = [];

		foreach ($this->bulan as $bl => $val) {
			$get = $this->TransaksiModel->GetTotalOrder($val);

			if ($get->num_rows() > 0) {
				$value[] = $get->row('total_order');
			} else {
				$value[] = 0;
			}
		}

		return $value;
	}
}
