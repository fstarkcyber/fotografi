<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaketModel extends CI_Model
{
	var $table = 'packets';
	var $table_images = 'packet_images';

	function GetPaket()
	{
		return $this->db->get($this->table);
	}

	function GetPacketImages($id_packet)
	{
		return $this->db->where('packet_id', $id_packet)->get($this->table_images);
	}
}
	
	/* End of file AuthModel.php */
	/* Location: ./application/models/AuthModel.php */
