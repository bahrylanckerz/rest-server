<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persons_model extends CI_Model {

	public function get($id=null)
	{
		if($id === null){
			return $this->db->get('persons')->result();
		}else{
			return $this->db->get_where('persons', ['id'=>$id])->row();
		}
	}

	public function insert($data)
	{
		$this->db->insert('persons', $data);
		return $this->db->affected_rows();
	}

	public function update($data,$id)
	{
		$this->db->update('persons', $data, ['id'=>$id]);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$this->db->delete('persons', ['id'=>$id]);
		return $this->db->affected_rows();
	}

	public function count_all()
	{
		return $this->db->get('persons')->num_rows();
	}

}

/* End of file Persons_model.php */
/* Location: ./application/models/Persons_model.php */