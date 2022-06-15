<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $config = $this->db->get('config')->result_array();
		// foreach ($config as $cf) {
		// 	define("_{$cf['name']}", $cf['value']);
		// }

		$this->load->model('MenusModel');

		if ($this->session->userdata('logged') != true) {
			redirect(base_url('login'), 'refresh');
		}


		// $uri = $this->uri->segment(1);
		// $permission = $this->RolesMenusModel->check_access_group($uri);

		// // echo $this->db->last_query($permission);
		// if ($permission->num_rows() > 0) {
		// 	return true;
		// }else{
		// 	redirect('404_override','refresh');
		// }
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
