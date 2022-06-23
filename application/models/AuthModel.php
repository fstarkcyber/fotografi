<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{

	function login($email)
	{
		$this->db->select('u.*, r.name as role_name, r.slug');
		$this->db->from('users as u');
		$this->db->join('roles as r', 'r.id = u.role_id', 'left');
		$this->db->where('u.email', $email);
		return $this->db->get();
	}

	function update($data, $id)
	{
		return $this->db->update('users', $data, ['id' => $id]);
	}

	function add($data)
	{
		return $this->db->insert('users', $data);
	}
}
	
	/* End of file AuthModel.php */
	/* Location: ./application/models/AuthModel.php */
