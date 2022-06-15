<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenusModel extends CI_Model
{
	function getMenu()
	{
		$this->db->where('parrent_id', 0);
		$this->db->where('role_id', $this->session->userdata('role_id'));
		$this->db->order_by('sequence', 'ASC');
		$menus = $this->db->get('menus')->result();

		$i = 0;
		foreach ($menus as $cat) {
			$menus[$i]->sub = $this->getSubMenu($cat->id);
			$i++;
		}
		return $menus;
	}

	function getSubMenu($id)
	{
		$this->db->where('parrent_id', $id);
		$this->db->where('role_id', $this->session->userdata('role_id'));
		$this->db->order_by('sequence', 'ASC');
		$menus = $this->db->get('menus')->result();

		$i = 0;
		foreach ($menus as $cat) {
			$menus[$i]->sub = $this->getSubMenu($cat->id);
			$i++;
		}
		return $menus;
	}
}
