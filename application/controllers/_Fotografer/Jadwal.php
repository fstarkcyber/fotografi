<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TransaksiModel');
		$this->load->helper('upload');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'jadwal-f', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/_fotografer/jadwal',
			'plugin' => 'plugins/_fotografer/jadwal',
			'css' => 'css/jadwal',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetJadwal()
	{
		$data = [];
		$where['t.payment_validation_by != '] = NULL;
		$trx = $this->TransaksiModel->GetTransaction($where)->result();


		foreach ($trx as $tr) {
			$photographer = '';
			$action = '';
			$status = '';
			$date = $tr->datetime_fix;

			if ($tr->photographer_id == NULL) {
				$status = '<span class="badge badge-warning">Menunggu Photographer</span>';
				$photographer = '<span class="badge badge-danger">Belum ada</span>';
				$action = '<a href="#!" class="table-action text-primary btn-take" data-id="' . $tr->id_transaction . '"  data-date="' . date('d-m-Y H:i:s', strtotime($date)) . '" data-price="' . number_format($tr->packet_price) . '" data-booking="' . $tr->booking_code . '" title="Ambil Jadwal"><i class="fas fa-bolt"></i> Take</a>';
			} else if ($tr->photographer_finish_confirm == NULL) {
				$photographer = $tr->photographer_name;
				$action = '<a href="#!" class="table-action text-primary btn-finish" data-id="' . $tr->id_transaction . '"  data-date="' . date('d-m-Y H:i:s', strtotime($date)) . '" data-price="' . number_format($tr->packet_price) . '" data-booking="' . $tr->booking_code . '" title="Ambil Jadwal"><i class="fas fa-trophy"></i> Finish</a>';
				$status = '<span class="badge badge-primary">Sedang Berjalan</span>';
			} else {
				$status = '<span class="badge badge-success">Transaksi Selesai</span>';
			}

			$data[] = array(
				'booking_code' => $tr->booking_code,
				'created_at' => $tr->created_at,
				'customer_id' => $tr->customer_id,
				'datetime' => date('d-m-Y H:i:s', strtotime($date)),
				'email' => $tr->email,
				'id_transaction' => $tr->id_transaction,
				'name' => $tr->name,
				'note' => $tr->note,
				'packet_duration' => $tr->packet_duration,
				'packet_id' => $tr->packet_id,
				'packet_name' => $tr->packet_name,
				'packet_price' => number_format($tr->packet_price),
				'payment_date' => $tr->payment_date,
				'payment_image' => $tr->payment_image,
				'payment_validation_at' => $tr->payment_validation_at,
				'payment_validation_by' => $tr->payment_validation_by,
				'photographer_finish_confirm' => $tr->photographer_finish_confirm,
				'photographer_id' => $tr->photographer_id,
				'photographer_take_booking' => $tr->photographer_take_booking,
				'role_id' => $tr->role_id,
				'updated_at' => $tr->updated_at,
				'photographer_name' => $photographer,
				'status' => $status,
				'action' => $action
			);
		}

		echo json_encode($data);
	}

	public function TakeTimetable()
	{
		$id_transaction = str_replace("'", "", htmlspecialchars($this->input->post('id_transaction'), ENT_QUOTES));
		$data['photographer_id'] = $this->session->userdata('id');
		$data['photographer_take_booking'] = date('Y-m-d H:i:s');

		// var_dump($data);
		// die;

		$act = $this->TransaksiModel->update($data, $id_transaction);

		// echo $this->db->last_query($act);
		// die;

		if ($act) {
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'Konfirmasi berhasil, persiapkan peralatan dan datang tepat waktu !.'
			);
		} else {
			$response = array(
				'type' => 'warning',
				'title' => 'Gagal !!!',
				'message' => 'Konfirmasi gagal, silahkan submit ulang !'
			);
		}

		echo json_encode($response);
	}

	public function FinishConfirm()
	{
		$id_transaction = str_replace("'", "", htmlspecialchars($this->input->post('id_transaction'), ENT_QUOTES));
		$data['photographer_finish_confirm'] = date('Y-m-d H:i:s');

		// var_dump($data);
		// die;

		$act = $this->TransaksiModel->update($data, $id_transaction);

		// echo $this->db->last_query($act);
		// die;

		if ($act) {
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'Konfirmasi berhasil, transaksi selesai !.'
			);
		} else {
			$response = array(
				'type' => 'warning',
				'title' => 'Gagal !!!',
				'message' => 'Konfirmasi gagal, silahkan submit ulang !'
			);
		}

		echo json_encode($response);
	}
}
