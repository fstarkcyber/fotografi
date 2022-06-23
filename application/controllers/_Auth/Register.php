<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		// $config = $this->db->get('config')->result_array();
		// foreach ($config as $cf) {
		// 	define("_{$cf['name']}", $cf['value']);
		// }
		$this->load->model('AuthModel');
	}

	public function index()
	{

		$data = [
			'content' => 'components/auth/register',
			'plugin' => 'plugins/auth/register',
		];

		$this->load->view('layouts/auth', $data);
	}

	public function process()
	{

		$this->form_validation->set_rules('name', 'Nama', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[255]|is_unique[users.email]');
		$this->form_validation->set_rules('hp', 'Hp', 'required|trim|numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('password_confirm', 'Password', 'required|trim|matches[password]');

		if ($this->form_validation->run() == true) {
			$user['name'] = str_replace("'", "", htmlspecialchars($this->input->post('name'), ENT_QUOTES));
			$user['email'] = str_replace("'", "", htmlspecialchars($this->input->post('email'), ENT_QUOTES));
			$user['hp'] = str_replace("'", "", htmlspecialchars($this->input->post('hp'), ENT_QUOTES));
			$user['password'] = password_hash(str_replace("'", "", htmlspecialchars($this->input->post('password'), ENT_QUOTES)), PASSWORD_DEFAULT);
			$user['role_id'] = 3;
			$user['status'] = 1;

			$row = $this->AuthModel->add($user);

			if ($row) {
				$response = array(
					'type' => 'success',
					'title' => 'Berhasil !!!',
					'message' => 'Registrasi berhasil, silahkan lakukan login !',
					'redirect' => base_url('login'),
				);
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
}
