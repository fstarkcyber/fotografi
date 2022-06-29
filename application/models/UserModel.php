<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
	var $table = 'users';
	var $column_order = array(null, 'u.name', 'u.email', 'u.hp', 'u.role_id');
	var $column_search = array('u.name', 'u.email', 'u.hp', 'r.role_name'); //field yang diizin untuk pencarian 
	var $order = array('u.created_at' => 'desc'); // default order 

	// Datatable
	private function _get_datatables_query()
	{
		$this->db->select('r.name as role_name, u.name, u.hp, u.email, u.id, u.role_id, u.status, u.images');
		$this->db->join('roles as r', 'r.id = u.role_id', 'left');
		$this->db->from($this->table . ' as u');
		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function getUsers()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	// Datatable End

	function getAll($limit, $where = null)
	{
		$this->db->select('u.*, r.name as role_name, r.slug as role_slug');
		$this->db->join('roles as r', 'r.id = u.role_id', 'LEFT');
		$this->db->order_by('name', 'asc');
		// $this->db->group_by('p.id');
		$this->db->where('u.role_id', 3);
		if ($where != null) {
			$this->db->where($where);
		}

		$this->db->limit($limit, 0);
		$this->db->from($this->table);
		return $this->db->get();
	}

	function getAllFotografer($where = null)
	{
		$this->db->select('u.*, r.name as role_name, r.slug as role_slug');
		$this->db->join('roles as r', 'r.id = u.role_id', 'LEFT');
		$this->db->order_by('name', 'asc');
		// $this->db->group_by('p.id');
		$this->db->where('u.role_id', 2);
		if ($where != null) {
			$this->db->where($where);
		}
		$this->db->from($this->table . ' as u');
		return $this->db->get();
	}

	function getById($id)
	{
		return $this->db->where('id', $id)->get($this->table);
	}

	function add($data)
	{
		return $this->db->insert($this->table, $data);
	}

	function update($id, $data)
	{
		return $this->db->update($this->table, $data, ['id' => $id]);
	}

	function delete($id)
	{
		return $this->db->delete($this->table, ['id' => $id]);
	}

	function count_all()
	{
		return $this->db->count_all_results($this->table);
	}

	public function validasi($where)
	{
		return $this->db->where($where)->get($this->table);
	}

	function getRoles()
	{
		return $this->db->get('roles');
	}

	function countUser()
	{
		$this->db->select('SUM(IF(role_id=1,1,0)) AS total_admin');
		$this->db->select('SUM(IF(role_id=2,1,0)) AS total_fotografer');
		$this->db->select('SUM(IF(role_id=3,1,0)) AS total_customer');
		$this->db->from($this->table);
		return $this->db->get();
	}
}

/* End of file ProductModel.php */
/* Location: ./application/models/ProductModel.php */
