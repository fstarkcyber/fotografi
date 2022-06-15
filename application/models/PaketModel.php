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

	function GetPaketById($id)
	{
		$this->db->where('id_packet', $id);
		$this->db->from($this->table);
		return $this->db->get();
	}

	function add($data, $image)
	{
		$this->db->trans_start();
        $this->db->insert($this->table, $data);
        $packet_id = $this->db->insert_id();

        $result = array();

        foreach ($image as $i => $value) {
            $result[] = array(
                'packet_id' => $packet_id,
                'image_name' => $value['image_name'],
            );
        }

        $this->db->insert_batch($this->table_images, $result);
        $this->db->trans_complete();

        return true;
	}

	function update($data, $id)
	{
		return $this->db->update($this->table, $data, ['id_packet' =>$id]);
	}

	function delete($id)
	{
		return $this->db->delete($this->table, ['id_packet'=>$id]);
	}

	function addImage($data)
	{
		return $this->db->insert($this->table_images, $data);
	}
}
	
	/* End of file AuthModel.php */
	/* Location: ./application/models/AuthModel.php */
