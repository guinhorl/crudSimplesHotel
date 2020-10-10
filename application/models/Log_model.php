<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends CI_Model
{

	public function isertLog($data){
		$this->db->insert('log', $data);
	}

	public function listarLogs(){
		$this->db->select('id, descricao, tipo, data')->from('log');
		$result = $this->db->get()->result();
		if($result)
			return $result;
		else
			return false;
	}

}
