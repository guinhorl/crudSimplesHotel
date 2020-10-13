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
			'tipo' => 'Cadastrado',
			'data' => $now->format('d-m-Y H:i:s')
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
				'tipo' => 'Deletado',
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
				//Atualização do log
				$descricao = $this->upLog($id, $updateData['nome'], $updateData['email']);

				$dataLog = array(
					'descricao' => $descricao,
					'tipo' => 'Atualizado',
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

	public function upLog($idUser, $nome, $email)
	{
		$user = $this->userModel->getUsers($idUser);

		if ($user->email != $email && $user->nome != $nome) {
			$descricao = "O email foi atualiza de (" . $user->email . "), para (" . $email . ") e 
			o nome foi atualiza de (" . $user->nome . "), para (" . $nome . ")";
		} else if($user->nome != $nome){
			$descricao = "O nome foi atualiza de (" . $user->nome . "), para (" . $nome . ")";
		} else {
			$descricao = "O email foi atualiza de (" . $user->email . "), para (" . $email . ")";
		}
		return $descricao;
	}

	public function enviarEmail(){
		$this->load->library("phpmailer_library");
		$Mailer = $this->phpmailer_library->load();


		//Define que será usado SMTP
		$Mailer->IsSMTP();
		//Enviar e-mail em HTML
		$Mailer->isHTML(true);
		//Aceitar carasteres especiais
		$Mailer->Charset = 'Utf-8';
		//Configurações
		$Mailer->SMTPAuth = true;
		$Mailer->SMTPSecure = 'ssl';
		//nome do servidor
		$Mailer->Host = 'smtp.gmail.com';
		//Porta de saida de e-mail
		$Mailer->Port = 465;
		//Dados do e-mail de saida - autenticação
		$Mailer->Username = 'guinhorlima@gmail.com';
		$Mailer->Password = '';
		//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
		$Mailer->From = 'guinhorlima@gmail.com';
		//Nome do Remetente
		$Mailer->FromName = 'Wagner Ramos';
		//Assunto da mensagem
		$Mailer->Subject = 'Link do codigo fonte do CRUD';
		//Corpo da Mensagem
		$Mailer->Body = '<h5>CRUD Codeingniter Desenvolvedor Junior</h5>
		<p>Segui o link no github do projeto para canditado a desenvolvedor Junior</p>
		<p><a href="https://github.com/guinhorl/crudSimplesHotel">CRUD Simplehotel</a></p>';
		//Corpo da mensagem em texto
		$Mailer->AltBody = 'conteudo do E-mail em texto';

		//Destinatario
		$Mailer->AddAddress('wagnerramosl@yahoo.com.br');

		if($Mailer->Send()){
			$this->session->set_flashdata('mensagemEmail', "<div class='alert alert-success'><strong>Email enviado com sucesso!</strong>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect(base_url());
		}else{
			echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
			$this->session->set_flashdata('mensagemEmail', "<div class='alert alert-danger'><strong>Erro </strong>no envio do email!
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect(base_url());
		}
	}

}
