<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		// $config = $this->db->get('config')->result_array();
		// foreach ($config as $cf) {
		// 	define("_{$cf['name']}", $cf['value']);
		// }
		$this->load->helper('String');
		$this->load->model('AuthModel');
	}

	public function index()
	{

		$data = [
			'content' => 'components/auth/login',
			'plugin' => 'plugins/auth/login',
		];

		$cookie = get_cookie('ftg');
		if ($this->session->userdata('logged')) {
			redirect(base_url('dashboard'), 'refresh');
		} else if ($cookie != '') {
			$row = $this->AuthModel->get_by_cookie($cookie)->row();
			if ($row) {
				$this->_reg_session($row);
			} else {
				$this->load->view('layouts/auth', $data);
			}
		} else {
			$this->load->view('layouts/auth', $data);
		}
	}

	public function process()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');

		if ($this->form_validation->run() == true) {
			$email = str_replace("'", "", htmlspecialchars($this->input->post('email'), ENT_QUOTES));
			$password = str_replace("'", "", htmlspecialchars($this->input->post('password'), ENT_QUOTES));
			$remember = $this->input->post('remember_me');

			$row = $this->AuthModel->login($email)->row();

			if ($row) {
				if ($row->status != 0) {
					if (password_verify($password, $row->password)) {

						if ($remember) {
							$key = random_string('alnum', 64);

							set_cookie('ftg', $key, 60 * 5);
							$update = array('remember_token' => $key);

							$this->AuthModel->update($update, $row->id);
						}

						$response = $this->_reg_session($row);
					} else {
						$response = array(
							'type' => 'error',
							'title' => 'Gagal !!!',
							'message' => 'Email atau password yang anda gunakan salah !',
							'redirect' => base_url('login'),
						);
					}
				} else {
					$response = array(
						'type' => 'warning',
						'title' => 'Gagal !!!',
						'message' => 'Akun anda belum aktif silahkan cek email atau hubungi administrator !',
						'redirect' => base_url('login'),
					);
				}
			} else {
				$response = array(
					'type' => 'error',
					'title' => 'Gagal !!!',
					'message' => 'Akun yang anda masukan salah atau belum terdaftar !',
					'redirect' => base_url('login'),
				);
			}
		} else {
			$response = array(
				'type' => 'error',
				'title' => 'Gagal !!!',
				'message' => validation_errors(),
				'redirect' => base_url('login'),
			);
		}

		echo json_encode($response);
	}

	public function _reg_session($row)
	{
		if ($row->images == NULL) {
			$image = 'default.png';
		} else {
			$image = $row->images;
		}

		$data_session = array(
			'id'               => $row->id,
			'email'            => $row->email,
			'name'             => $row->name,
			'images'           => $image,
			'role_id'          => $row->role_id,
			'role_name'        => $row->role_name,
			'role_slug'        => $row->slug,
			'logged'           => TRUE
		);

		$this->session->set_userdata($data_session);
		// activity_log('login', 'Telah Melakukan Login');

		$response = array(
			'type' => 'success',
			'title' => 'Berhasil !',
			'message' => 'Anda berhasil login, halaman ini akan di alihkan.',
			'redirect' => base_url('dashboard'),
		);

		return $response;
	}

	public function logout()
	{
		delete_cookie('ftg');
		// activity_log('logout', 'Telah Melakukan Logout');

		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}

	public function create()
	{
		echo password_hash('password', PASSWORD_DEFAULT);
	}
}
