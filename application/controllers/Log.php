<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller
{
	public function __construct(){
		parent:: __construct();
		$this->load->model('log_model', 'logModel');
	}

	public function Logs(){
		$data['logs'] = $this->logModel->listarLogs();
		$this->load->view('commos/header');
		$this->load->view('log', $data);
		$this->load->view('commos/footer');
	}

}
