<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_Model
{

	public function cadastrarUser($data){
		$this->db->insert('usuario', $data);
	}

	public function editarUser($id, $data){
		$this->db->where('id',$id);
		$this->db->update('usuario', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	public function deletarUser($id){
		$this->db->where('id',$id);
		$this->db->delete('usuario');
		/*$this->db->affected_rows() > 0 ? true : false;*/
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	public function listarUsers(){
		$result = $this->db->select('*')->from('usuario');
		if($result)
			return $result;
		else
			return false;
	}

}
