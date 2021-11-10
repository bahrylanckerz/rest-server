<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

	public function get_item($id=NULL)
	{
		if ($id === NULL) {
			$this->db->select('*');
			$this->db->from('tbl_item');
			$query = $this->db->get();
			return $query->result();
		} else {
			$this->db->select('*');
			$this->db->from('tbl_item');
			$this->db->where('id_item', $id);
			$query = $this->db->get();
			return $query->result();
		}
	}

	public function insert($data)
	{
		$this->db->insert('tbl_item', $data);
		return $this->db->affected_rows();
	}

	public function update($data,$id)
	{
		$this->db->update('tbl_item', $data, ['id_item'=>$id]);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$this->db->delete('tbl_item', ['id_item'=>$id]);
		return $this->db->affected_rows();
	}

}

/* End of file Item_model.php */
/* Location: ./application/models/Item_model.php */