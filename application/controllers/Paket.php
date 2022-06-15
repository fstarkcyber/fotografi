<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PaketModel');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'master-data', 'sub_menu_active' => 'paket']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/paket',
			'plugin' => 'plugins/paket',
			'css' => 'css/paket',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetPaket()
	{
		$data = array();
		$paket = $this->PaketModel->GetPaket()->result();
		foreach ($paket as $pk => $val) {
			$data[] = array(
				'id_packets' => $val->id_packet,
				'packet_name' => $val->packet_name,
				'packet_duration' => $val->packet_duration,
				'packet_price' => $val->packet_price,
				'packet_price_slug' => substr_replace($val->packet_price, 'K', -3),
				'packet_description' => $val->packet_description,
				'membership' => $val->membership,
				'created_at' => $val->created_at,
				'updated_at' => $val->updated_at,
				'packet_images' => $this->PaketModel->GetPacketImages($val->id_packet)->result()
			);
		}
		echo json_encode($data);
	}
}
