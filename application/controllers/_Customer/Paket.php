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
		$this->session->set_userdata(['menu_active' => 'paket-c', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/_customer/paket',
			'plugin' => 'plugins/_customer/paket',
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
				'id_packet' => $val->id_packet,
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

	public function GetPaketById($id)
	{
		// $data = array();
		$paket = $this->PaketModel->GetPaketById($id)->row();

		// echo $this->db->last_query($paket);
		// die;
		// var_dump($paket);
		// die;

		$data = array(
			'id_packet' => $paket->id_packet,
			'packet_name' => $paket->packet_name,
			'packet_duration' => $paket->packet_duration,
			'packet_price' => $paket->packet_price,
			'packet_price_slug' => substr_replace($paket->packet_price, 'K', -3),
			'packet_description' => $paket->packet_description,
			'membership' => $paket->membership,
			'created_at' => $paket->created_at,
			'updated_at' => $paket->updated_at,
			'packet_images' => $this->PaketModel->GetPacketImages($paket->id_packet)->result()
		);

		echo json_encode($data);
	}
}
