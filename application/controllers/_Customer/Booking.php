<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TransaksiModel');
		$this->load->helper('upload');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'booking-c', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/_customer/booking',
			'plugin' => 'plugins/_customer/booking',
			'css' => 'css/default',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function transaksi()
	{
		$this->session->set_userdata(['menu_active' => 'transaksi-c', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/_customer/transaksi',
			'plugin' => 'plugins/_customer/transaksi',
			'css' => 'css/transaksi',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetTransaction()
	{
		$data = [];
		$where['t.customer_id'] = $this->session->userdata('id');
		$trx = $this->TransaksiModel->GetTransaction($where)->result();


		foreach ($trx as $tr) {
			$status = '';
			$action = '<a href="#!" class="table-action btn btn-warning btn-sm text-white btn-preview" 
						data-name="' . $tr->name . '"  
						data-email="' . $tr->email . '" 
						data-note="' . $tr->note . '" 
						data-id="' . $tr->id_transaction . '" 
						data-price="' . number_format($tr->packet_price) . '" 
						data-booking="' . $tr->booking_code . '" 
						data-packet-name="' . $tr->packet_name . '" 
						data-packet-price="' . $tr->packet_price . '" 
						data-packet-duration="' . $tr->packet_duration . '" 
						data-created-at="' . $tr->created_at . '" 
						
						title="Preview Invoice"><i class="fas fa-eye"></i></a>';

			$date = $tr->datetime;

			if ($tr->payment_date == NULL || $tr->payment_image == NULL) {
				$status = '<span class="badge badge-danger">Menunggu Pembayaran</span>';
				$action .= '<a href="#!" class="table-action btn btn-sm btn-success text-white btn-confirm" 
								data-id="' . $tr->id_transaction . '" 
								data-price="' . number_format($tr->packet_price) . '" 
								data-booking="' . $tr->booking_code . '" 
								data-packet-name="' . $tr->packet_name . '" 
								data-packet-price="' . $tr->packet_price . '" 
								data-booking="' . $tr->booking_code . '" 
								title="Konfirmasi Pembayaran"><i class="fas fa-credit-card"></i></a>';
			} else if ($tr->payment_validation_at == NULL || $tr->payment_validation_by == NULL) {
				$status = '<span class="badge badge-warning">Menunggu Validasi</span>';
			} else {
				if ($tr->datetime != $tr->datetime_fix) {
					$date = $tr->datetime_fix;
					$status = '<span class="badge badge-success">Validasi Berhasil</span><span class="badge badge-danger">Jadwal di ubah</span>';
				} else {
					$status = '<span class="badge badge-success">Validasi Berhasil</span>';
				}
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
				'status' => $status,
				'action' => $action
			);
		}

		echo json_encode($data);
	}

	public function add()
	{
		$image = array();
		$this->form_validation->set_rules('datetime', 'Tanggal & Waktu', 'required');

		if ($this->form_validation->run() == true) {
			$data['packet_id'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_id'), ENT_QUOTES));
			$data['datetime'] = str_replace("'", "", htmlspecialchars($this->input->post('datetime'), ENT_QUOTES));
			$data['note'] = str_replace("'", "", htmlspecialchars($this->input->post('note'), ENT_QUOTES));
			$data['booking_code'] =  date('YmdHis');
			$data['customer_id'] =  $this->session->userdata('id');

			$act = $this->TransaksiModel->add($data);

			if ($act) {
				$response = array(
					'type' => 'success',
					'title' => 'Berhasil !!!',
					'message' => 'Booking berhasil, silahkan lakukan pembayaran dan konfirmasi pada halaman riwayat transaksi !.'
				);
			} else {
				$response = array(
					'type' => 'warning',
					'title' => 'Gagal !!!',
					'message' => 'Booking gagal, silahkan submit ulang !'
				);
			}
		} else {
			$response = array(
				'type' => 'error',
				'title' => 'Gagal !!!',
				'message' => validation_errors(),
			);
		}

		echo json_encode($response);
	}

	public function payment_confirm()
	{
		$id_transaction = str_replace("'", "", htmlspecialchars($this->input->post('id_transaction'), ENT_QUOTES));
		$booking_code = str_replace("'", "", htmlspecialchars($this->input->post('booking_code'), ENT_QUOTES));

		if (!empty($_FILES['payment_image']['name'])) {
			$upload = h_upload($booking_code, 'assets/img/transactions', 'jpg|png|jpeg', '2048', 'payment_image');

			if (!empty($upload['success'])) {
				$data['payment_image'] = $upload['success']['file_name'];
			} else {
				$response = array(
					'type' => 'warning',
					'title' => 'Gagal !!!',
					'message' => 'Gagal Upload, silahkan submit ulang !'
				);
			}
		}

		$data['payment_date'] = date('Y-m-d H:i:s');

		// var_dump($data);
		// die;

		$act = $this->TransaksiModel->update($data, $id_transaction);

		// echo $this->db->last_query($act);
		// die;

		if ($act) {
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'Konfirmasi berhasil, harap menunggu konfirmasi dari pihak kami !.'
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
