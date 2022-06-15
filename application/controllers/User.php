<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		// $this->load->helper('upload');
		// $this->load->library('pagination');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'users', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/users',
			'plugin' => 'plugins/users',
			'css' => 'css/users',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function show()
	{
		$list = $this->UserModel->getUsers();

		$data = array();
		$no = $_POST['start'];

		foreach ($list as $ls) {
			if ($ls->status == 1) {
				$status = 'checked';
			} else {
				$status = '';
			}

			if (!empty($ls->images)) {
				$images = $ls->images;
			} else {
				$images = '01.jpg';
			}

			$row = array();
			$row[] = '<img class="rounded-circle img-fluid avatar-40" src="' . base_url('assets/images/user/' . $images) . '" alt="profile">';
			$row[] = $ls->name;
			$row[] = $ls->email;
			$row[] = $ls->role_name;
			$row[] = '<div class="custom-control custom-switch custom-switch-text custom-control-inline">
                        <div class="custom-switch-inner">
                            <input type="checkbox" value="' . $ls->id . '" class="custom-control-input update-status-user" ' . $status . ' id="' . $ls->email . '">
                            <label class="custom-control-label" data-on-label="On" data-off-label="Off" for="' . $ls->email . '">
                            </label>
                        </div>
                    </div>';
			$row[] = ' <div class="flex align-items-center list-user-action">
                        <a data-id="' . $ls->id . '" class="iq-bg-warning btn-update" href="#" title="Edit"><i class="ri-pencil-line"></i></a>
                        <a data-id="' . $ls->id . '" class="iq-bg-danger btn-delete" href="#" title="Delete"><i class="ri-delete-bin-line"></i></a>
                    </div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->UserModel->count_all(),
			"recordsFiltered" => $this->UserModel->count_filtered(),
			"data" => $data
		);

		echo json_encode($output);
	}

	public function GetUserById($id)
	{
		$data = $this->UserModel->getById(str_replace("'", "", htmlspecialchars($id, ENT_QUOTES)))->row();
		echo json_encode($data);
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[255]|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('conf_password', 'Password', 'required|trim|matches[password]');

		if ($this->form_validation->run() == true) {
			$user['name'] = str_replace("'", "", htmlspecialchars($this->input->post('name'), ENT_QUOTES));
			$user['email'] = str_replace("'", "", htmlspecialchars($this->input->post('email'), ENT_QUOTES));
			$user['password'] = password_hash(str_replace("'", "", htmlspecialchars($this->input->post('password'), ENT_QUOTES)), PASSWORD_DEFAULT);
			$user['role_id'] = str_replace("'", "", htmlspecialchars($this->input->post('role_id'), ENT_QUOTES));
			$user['status'] = 0;

			if (!empty($_FILES['images']['name'])) {
				$images = h_upload(md5($user['email']), 'assets/images/user', 'gif|jpg|png|jpeg', '1024', 'images');

				if (!empty($images['success'])) {
					$user['images'] = $images['success']['file_name'];
				}
			}

			$user = $this->UserModel->add($user);

			if ($user) {
				$response = array(
					'type' => 'success',
					'title' => 'Berhasil !!!',
					'message' => 'Data user berhasil di tambah.'
				);
			} else {
				$response = array(
					'type' => 'warning',
					'title' => 'Gagal !!!',
					'message' => 'Data user gagal di tambah !'
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

	public function update()
	{
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[1]|max_length[255]');

		if ($this->form_validation->run() == true) {
			$id =  str_replace("'", "", htmlspecialchars($this->input->post('id'), ENT_QUOTES));
			$user['name'] = str_replace("'", "", htmlspecialchars($this->input->post('name'), ENT_QUOTES));
			$user['email'] = str_replace("'", "", htmlspecialchars($this->input->post('email'), ENT_QUOTES));
			$user['role_id'] = str_replace("'", "", htmlspecialchars($this->input->post('role_id'), ENT_QUOTES));

			if (!empty($_FILES['images']['name'])) {
				$images = h_upload(md5($user['email']), 'assets/images/user', 'gif|jpg|png|jpeg', '1024', 'images');

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

	public function delete()
	{
		$id =  str_replace("'", "", htmlspecialchars($this->input->post('id'), ENT_QUOTES));

		$delete = $this->UserModel->delete($id);
		if ($delete) {
			log_activity('delete', 'delete user', 'delete data user pada halaman user');
			$response = array(
				'type' => 'success',
				'title' => 'Berhasil !!!',
				'message' => 'Data user berhasil di hapus.'
			);
		} else {
			$response = array(
				'type' => 'warning',
				'title' => 'Gagal !!!',
				'message' => 'Data user gagal di hapus !'
			);
		}

		echo json_encode($response);
	}

	public function updateStatus()
	{
		$id = str_replace("'", "", htmlspecialchars($this->input->post('id'), ENT_QUOTES));
		$check_status = $this->db->get_where('users', ['id' => $id])->row();
		if ($check_status->status == 1) {
			$data['status'] = 0;
		} else {
			$data['status'] = 1;
		}

		$act = $this->UserModel->update($id, $data);
		if ($act) {
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

		echo json_encode($response);
	}
}
