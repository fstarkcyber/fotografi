<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->helper('upload');
		// $this->load->library('pagination');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'profile', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/profile',
			'plugin' => 'plugins/profile',
			'css' => 'css/profile',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetUserById()
	{
		$id = $this->session->userdata('id');
		$data = $this->UserModel->getById(str_replace("'", "", htmlspecialchars($id, ENT_QUOTES)))->row();
		echo json_encode($data);
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('hp', 'Hp', 'required|numeric|trim');

		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_confirm', 'Password', 'required|matches[password]');
		}

		if ($this->form_validation->run() == true) {
			$id =  $this->session->userdata('id');
			$user['name'] = str_replace("'", "", htmlspecialchars($this->input->post('name'), ENT_QUOTES));
			$user['hp'] = str_replace("'", "", htmlspecialchars($this->input->post('hp'), ENT_QUOTES));
			$user['email'] = str_replace("'", "", htmlspecialchars($this->input->post('email'), ENT_QUOTES));

			if ($this->input->post('password')) {
				$user['password'] = password_hash(str_replace("'", "", htmlspecialchars($this->input->post('password'), ENT_QUOTES)), PASSWORD_DEFAULT);
			}

			if (!empty($_FILES['images']['name'])) {
				$images = h_upload(md5($user['email']), 'assets/img/users', 'gif|jpg|png|jpeg', '1024', 'images');

				if (!empty($images['success'])) {
					$user['images'] = $images['success']['file_name'];
				}
			}

			$user = $this->UserModel->update($id, $user);

			if ($user) {
				$response = array(
					'type' => 'success',
					'title' => 'Berhasil !!!',
					'message' => 'Data user berhasil di ubah.'
				);
			} else {
				$response = array(
					'type' => 'warning',
					'title' => 'Gagal !!!',
					'message' => 'Data user gagal di ubah !'
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
}
