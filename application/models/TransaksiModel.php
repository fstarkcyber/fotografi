<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiModel extends CI_Model
{
	var $table = 'transactions';

	function GetTransaction($where = null)
	{
		$this->db->select('u.name, u.email, u.hp, pt.name as photographer_name, pt.hp as photographer_hp, pt.email as photographer_email, u.role_id, p.packet_name, p.packet_duration, p.packet_price, t.*');
		$this->db->join('users as pt', 'pt.id = t.photographer_id', 'LEFT');
		$this->db->join('users as u', 'u.id = t.customer_id', 'LEFT');
		$this->db->join('packets as p', 'p.id_packet = t.packet_id', 'LEFT');
		$this->db->from($this->table . ' as t');
		if ($where != null) {
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function add($data)
	{
		return $this->db->insert($this->table, $data);
	}

	function update($data, $id)
	{
		return $this->db->update($this->table, $data, ['id_transaction' => $id]);
	}

	function delete($id)
	{
		return $this->db->delete($this->table, ['id_transaction' => $id]);
	}
}
	
	/* End of file AuthModel.php */
	/* Location: ./application/models/AuthModel.php */
