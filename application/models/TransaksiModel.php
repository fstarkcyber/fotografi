<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiModel extends CI_Model
{
	var $table = 'transactions';
	var $table_images = 'transaction_images';

	function GetTransaction($where = null)
	{
		$this->db->select('u.name, u.email, u.hp, u.images, pt.name as photographer_name, pt.hp as photographer_hp, pt.email as photographer_email, u.role_id, p.packet_name, p.packet_duration, p.packet_price, t.*');
		$this->db->join('users as pt', 'pt.id = t.photographer_id', 'LEFT');
		$this->db->join('users as u', 'u.id = t.customer_id', 'LEFT');
		$this->db->join('packets as p', 'p.id_packet = t.packet_id', 'LEFT');
		$this->db->from($this->table . ' as t');
		if ($where != null) {
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function GetTransactionValue($month)
	{
		$this->db->select('SUM(p.packet_price) as trx_value');
		$this->db->join('packets as p', 't.packet_id = p.id_packet', 'LEFT');
		$this->db->where('MONTHNAME(DATE(t.created_at))', $month);
		$this->db->where('t.payment_validation_at != ', NULL);
		$this->db->group_by('MONTHNAME(DATE(t.created_at))');
		$this->db->from($this->table . ' as t');
		return $this->db->get();
	}

	function GetImages()
	{
		return $this->db->get($this->table_images);
	}

	function GetTotalOrder($month)
	{
		$this->db->select('count(*) as total_order');
		$this->db->where('MONTHNAME(DATE(t.created_at))', $month);
		$this->db->where('t.payment_validation_at != ', NULL);
		$this->db->group_by('MONTHNAME(DATE(t.created_at))');
		$this->db->from($this->table . ' as t');
		return $this->db->get();
	}

	function add($data)
	{
		return $this->db->insert($this->table, $data);
	}

	function addImages($id, $image)
	{
		$this->db->trans_start();
		$result = array();

		foreach ($image as $i => $value) {
			$result[] = array(
				'transaction_id' => $id,
				'image_name' => $value['image_name'],
			);
		}

		$this->db->insert_batch($this->table_images, $result);
		$this->db->trans_complete();

		return true;
	}

	function update($data, $id)
	{
		return $this->db->update($this->table, $data, ['id_transaction' => $id]);
	}

	function delete($id)
	{
		return $this->db->delete($this->table, ['id_transaction' => $id]);
	}

	function deleteGaleri($id)
	{
		return $this->db->delete('transaction_images', ['transaction_id' => $id]);
	}
}
	
	/* End of file AuthModel.php */
	/* Location: ./application/models/AuthModel.php */
