<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TransaksiModel');
		$this->load->helper('upload');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'hasil-foto-f', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/_fotografer/hasil',
			'plugin' => 'plugins/_fotografer/hasil',
			'css' => 'css/hasil',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetJadwal()
	{
		$data = [];
		$where['t.photographer_finish_confirm != '] = NULL;
		$trx = $this->TransaksiModel->GetTransaction($where)->result();

		foreach ($trx as $tr) {
			$photographer = '';
			$action = '';
			$status = '';
			$date = $tr->datetime_fix;

			$check_images = $this->db->get_where('transaction_images', ['transaction_id' => $tr->id_transaction]);

			if ($check_images->num_rows() == 0) {
				$action = '<a href="#!" class="btn btn-sm btn-primary table-action text-white btn-upload" data-id="' . $tr->id_transaction . '"  data-date="' . date('d-m-Y H:i:s', strtotime($date)) . '" data-price="' . number_format($tr->packet_price) . '" data-booking="' . $tr->booking_code . '" title="Upload Hasil">Upload</a>';
			} else {
				$action = '<a href="#!" class="btn btn-sm  btn-danger table-action text-white btn-hapus-hasil" data-id="' . $tr->id_transaction . '" >Hapus Foto</a>';
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

	public function add()
	{
		$image = array();

		if (!empty($_FILES['image1']['name'])) {
			$upload = h_upload($_FILES['image1']['name'], 'assets/img/galeri', 'jpg|png|jpeg', '2048', 'image1');

			if (!empty($upload['success'])) {
				$image[]['image_name'] = $upload['success']['file_name'];
			}
		}

		if (!empty($_FILES['image2']['name'])) {
			$upload = h_upload($_FILES['image2']['name'], 'assets/img/galeri', 'jpg|png|jpeg', '2048', 'image2');

			if (!empty($upload['success'])) {
				$image[]['image_name'] = $upload['success']['file_name'];
			}
		}

		if (!empty($_FILES['image3']['name'])) {
			$upload = h_upload($_FILES['image3']['name'], 'assets/img/galeri', 'jpg|png|jpeg', '2048', 'image3');

			if (!empty($upload['success'])) {
				$image[]['image_name'] = $upload['success']['file_name'];
			}
		}

		if (!empty($_FILES['image4']['name'])) {
			$upload = h_upload($_FILES['image4']['name'], 'assets/img/galeri', 'jpg|png|jpeg', '2048', 'image4');

			if (!empty($upload['success'])) {
				$image[]['image_name'] = $upload['success']['file_name'];
			}
		}

		if (!empty($_FILES['image5']['name'])) {
			$upload = h_upload($_FILES['image5']['name'], 'assets/img/galeri', 'jpg|png|jpeg', '2048', 'image5');

			if (!empty($upload['success'])) {
				$image[]['image_name'] = $upload['success']['file_name'];
			}
		}

		$id = $this->input->post('id_transaction');
		$act = $this->TransaksiModel->addImages($id, $image);
		if ($act) {
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'hasil foto berhasil ditambahkan.'
			);
		} else {
			$response = array(
				'type' => 'warning',
				'title' => 'Gagal !!!',
				'message' => 'hasil foto gagal ditambahkan, periksa size image maksimal 2MB !'
			);
		}

		echo json_encode($response);
	}

	public function delete()
	{
		$id_transaction = str_replace("'", "", htmlspecialchars($this->input->post('transaction_id'), ENT_QUOTES));

		$data = $this->db->get('transaction_images', ['transaction_id' => $id_transaction]);
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $dt) {
				unlink('./assets/img/galeri/' . $dt->image_name);
			}
		}

		$act = $this->TransaksiModel->deleteGaleri($id_transaction);

		if ($act) {
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'Data  berhasil dihapus.'
			);
		} else {
			$response = array(
				'type' => 'warning',
				'title' => 'Gagal !!!',
				'message' => 'Data paket gagal dihapus !'
			);
		}

		echo json_encode($response);
	}
}
