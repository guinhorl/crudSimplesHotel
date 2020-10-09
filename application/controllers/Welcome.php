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
	public function editar(){
		//$user = $this->userModel->existeIdUser($id);
		//echo $id;
		$this->load->view('editar-user');
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

	public function deletarUser($id){
		try {
			//Deleta o usuário
			$result = $this->userModel->deletarUser($id);
			//Conferi
			if($result){
				$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-success'>Usuário<strong> deletado </strong>com sucesso!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			}else{
				$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-danger'><strong>Erro </strong>ao deletar usuário!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			}

		}catch (Exception $error){
			$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-danger'><strong>". $error ."</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect(base_url());
		}
	}

	public function editarUser($id){

		try {
			if($this->userModel->existeIdUser($id)){
				$updateData = array(
					'nome' => $this->input->post('nomeUser'),
					'email' => $this->input->post('emailUser')
				);
				//Edita o usuário
				$result = $this->userModel->editarUser($id, $updateData);
				//Conferi!
				if($result) {
					$this->session->set_flashdata('mensagemEditar', "<div class='alert alert-success'>Usuário<strong> atualizado </strong>com sucesso!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
					redirect(base_url());
				}else{
					$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-danger'><strong>Erro </strong>ao atualizar o usuário!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
					redirect(base_url());
				}
			}

		}catch (Exception $error){
			$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-danger'><strong>". $error ."</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect(base_url());
		}


	}

}
