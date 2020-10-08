<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model', 'userModel');
	}

	public function index()
	{
		$data['user'] = $this->userModel->listarUsers();
		$this->load->view('home', $data);
	}

	public function cadastrar(){
		$now = new DateTime();
		$dataAgora = $now->format('Y-m-d');
		$data = array(
			'nome' => $this->input->post('nomeUser'),
			'email' => $this->input->post('emailUser'),
			'data_cadastro' => $dataAgora
		);
		try {
			if ($this->userModel->existeUser($data['email'])) {
				$this->session->set_flashdata('mensagemCadastro', "<div class='alert alert-danger'>Esse email <strong> já está cadastrado! </strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			} else {
				$this->userModel->cadastrarUser($data);
				$this->session->set_flashdata('mensagemCadastro', "<div class='alert alert-success'> Usuário <strong>Cadastrado com sucesso!</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			}
		} catch (Exception $erro) {
			$this->session->set_flashdata('mensagemCadastro', "<div class='alert alert-danger'> ERRO de <strong>cadstro</strong> do usuário! 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>" . $erro->getMessage());
		}
	}

}
