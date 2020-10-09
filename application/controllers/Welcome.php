<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model', 'userModel');
		$this->load->model('log_model', 'logModel');
	}

	public function index()
	{
		$data['user'] = $this->userModel->listarUsers();
		$this->load->view('commos/header');
		$this->load->view('home', $data);
		$this->load->view('commos/footer');
	}
	public function editar($id){

		try {
			$user = $this->userModel->getUsers($id);
			$data['id'] = $user->id;
			$data['nome'] = $user->nome;
			$data['email'] = $user->email;

			$this->load->view('commos/header');
			$this->load->view('editar', $data);
			$this->load->view('commos/footer');
		}catch (Exception $error){

		}
	}

	public function cadastrar(){
		$now = new DateTime();

		$data = array(
			'nome' => $this->input->post('nomeUser'),
			'email' => $this->input->post('emailUser'),
			'data_cadastro' => $now->format('d-m-Y')
		);
		//Dados do log
		$dataLog = array(
			'descricao' => $data['nome'] . ' foi cadastrado!',
			'tipo' => 1,
			'data' => $now->format('d-m-Y')
		);
		try {

			if ($this->userModel->existeUser($data['email'])) {
				$this->session->set_flashdata('mensagemCadastro', "<div class='alert alert-danger'>Esse email <strong> já está cadastrado! </strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			} else {
				$this->userModel->cadastrarUser($data);
				$this->logModel->isertLog($dataLog);
				$this->session->set_flashdata('mensagemCadastro', "<div class='alert alert-success'> Usuário <strong>Cadastrado com sucesso!</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			}
		} catch (Exception $erro) {
			$this->session->set_flashdata('mensagemCadastro', "<div class='alert alert-danger'> ERRO de <strong>cadstro</strong> do usuário! 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
		}
	}

	public function deletarUser($id){
		$now = new DateTime();
		try {
			$user = $this->userModel->getUsers($id);
			$dataLog = array(
				'descricao' => $user->nome . ' foi excluido!',
				'tipo' => 2,
				'data' => $now->format('Y-m-d H:i:s')
			);
			//Deleta o usuário
			$result = $this->userModel->deletarUser($id);

			//Conferi
			if($result){
				$this->logModel->isertLog($dataLog);
				$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-success'>Usuário<strong> deletado </strong>com sucesso!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			}else{
				$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-danger'><strong>Erro </strong>ao deletar usuário!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			}

		}catch (Exception $error){
			$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-danger'><strong>Vixxx não foi deletado não doidão!!</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect(base_url());
		}
	}

	public function editarUser($id){
		$now = new DateTime();
		try {
			if($this->userModel->existeIdUser($id)){
				$updateData = array(
					'nome' => $this->input->post('nomeUser'),
					'email' => $this->input->post('emailUser')
				);
				$dataLog = array(
					'descricao' => $updateData['nome'] . ' foi atualizado!',
					'tipo' => 3,
					'data' => $now->format('d-m-Y H:i:s')
				);
				//Edita o usuário
				$result = $this->userModel->editarUser($id, $updateData);
				//Conferi!
				if($result) {
					$this->logModel->isertLog($dataLog);
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
			$this->session->set_flashdata('mensagemDelete', "<div class='alert alert-danger'><strong>Vixxxx, foi atualizado não doido!!</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect(base_url());
		}
	}

	//Enviar link do projeto por email
	public function enviar(){
		//Variaveis com dados
		$to = 'teste@yahoo.com.br';
		$subject = 'CRUD para avaliação de desenvolvedor júnior';
		$from = 'teste@gmail.com';
		$emailContent = '<p>link do projeto no github</p> https://github.com/guinhorl/crudSimplesHotel';

		//
		try {
			/*$this->email->initialize($config);*/
			$this->email->from($from);
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($emailContent);
			//$this->email->send();
			if($this->email->send()){
				$this->session->set_flashdata('mensagemEmail', "<div class='alert alert-success'><strong>Email enviado com sucesso!</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());
			}else{
				$this->session->set_flashdata('mensagemEmail', "<div class='alert alert-danger'><strong>Erro </strong>no envio do email!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				redirect(base_url());

			}
		}catch (Exception $error){
			$this->session->set_flashdata('mensagemEmail', "<div class='alert alert-danger'><strong>Vixxxx </strong>algo de errado com o envio do email aconteceu, uma exceção foi disparada!
           	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect(base_url());
		}
	}
}
