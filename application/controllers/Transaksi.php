<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TransaksiModel');
		$this->load->helper('upload');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'transaksi', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/transaksi',
			'plugin' => 'plugins/transaksi',
			'css' => 'css/transaksi',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetTransaction()
	{
		$data = [];
		$trx = $this->TransaksiModel->GetTransaction()->result();


		foreach ($trx as $tr) {
			$status = '';
			$action = '';
			$date = $tr->datetime;

			if ($tr->payment_date == NULL || $tr->payment_image == NULL) {
				$status = '<span class="badge badge-danger">Menunggu Pembayaran</span>';
			} else if ($tr->payment_validation_at == NULL || $tr->payment_validation_by == NULL) {
				$action = '
							<a target="_blank" href="' . base_url('assets/img/transactions/' . $tr->payment_image) . '" class="table-action text-success" title="Lihat Bukti Pembayaran"><i class="fas fa-eye"></i></a>
							<a data-id="' . $tr->id_transaction . '" href="#" class="table-action text-danger btn-cancel-payment" title="Batal Validasi Pembayaran"><i class="fas fa-ban"></i></a>
							<a data-date="' . date('Y-m-d\TH:i', strtotime($tr->datetime)) . '" data-id="' . $tr->id_transaction . '" href="#" class="table-action text-primary btn-validation" title="Validasi Pembayaran"><i class="fas fa-check"></i></a>
							';
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

	public function GetTransactionFilter()
	{
		if ($this->session->userdata('role_id') == 3) {
			$where['t.customer_id'] = $this->session->userdata('id');
		} else if ($this->session->userdata('role_id') == 2) {
			$where['t.payment_validation_at != '] = NULL;
		} else {
			$where = null;
		}

		$data = [];
		$trx = $this->TransaksiModel->GetTransaction($where)->result();


		foreach ($trx as $tr) {
			$status = '';
			$action = '';
			$date = $tr->datetime;

			if ($tr->payment_date == NULL || $tr->payment_image == NULL) {
				$status = '<span class="badge badge-danger">Menunggu Pembayaran</span>';
			} else if ($tr->payment_validation_at == NULL || $tr->payment_validation_by == NULL) {
				$action = '
							<a target="_blank" href="' . base_url('assets/img/transactions/' . $tr->payment_image) . '" class="table-action text-success" title="Lihat Bukti Pembayaran"><i class="fas fa-eye"></i></a>
							<a data-id="' . $tr->id_transaction . '" href="#" class="table-action text-danger btn-cancel-payment" title="Batal Validasi Pembayaran"><i class="fas fa-ban"></i></a>
							<a data-date="' . date('Y-m-d\TH:i', strtotime($tr->datetime)) . '" data-id="' . $tr->id_transaction . '" href="#" class="table-action text-primary btn-validation" title="Validasi Pembayaran"><i class="fas fa-check"></i></a>
							';
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
				'images' => $tr->images,
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

	public function payment_validation()
	{
		$id_transaction = str_replace("'", "", htmlspecialchars($this->input->post('id_transaction'), ENT_QUOTES));
		$data['datetime_fix'] = str_replace("'", "", htmlspecialchars($this->input->post('datetime_fix'), ENT_QUOTES));
		$data['payment_validation_at'] = date('Y-m-d H:i:s');
		$data['payment_validation_by'] = $this->session->userdata('id');

		// var_dump($data);
		// die;

		$act = $this->TransaksiModel->update($data, $id_transaction);

		// echo $this->db->last_query($act);
		// die;

		if ($act) {
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'Validasi berhasil, transaksi akan di lanjutkan kepada fotografer !.'
			);
		} else {
			$response = array(
				'type' => 'warning',
				'title' => 'Gagal !!!',
				'message' => 'Validasi gagal, silahkan submit ulang !'
			);
		}

		echo json_encode($response);
	}

	public function payment_cancel()
	{
		$id_transaction = str_replace("'", "", htmlspecialchars($this->input->post('id_transaction'), ENT_QUOTES));

		$image = $this->db->get_where('transactions', ['id_transaction' => $id_transaction])->row('payment_image');
		unlink('./assets/img/transactions/' . $image);


		$data['payment_image'] = NULL;
		$data['payment_date'] = NULL;
		// var_dump($data);
		// die;

		$act = $this->TransaksiModel->update($data, $id_transaction);

		// echo $this->db->last_query($act);
		// die;

		if ($act) {
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'Cancel berhasil !.'
			);
		} else {
			$response = array(
				'type' => 'warning',
				'title' => 'Gagal !!!',
				'message' => 'Cancel gagal, Silahkan submit ulang !'
			);
		}

		echo json_encode($response);
	}
}
