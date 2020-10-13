<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	<a class="navbar-brand" href="#">CRUD Simpleshotel</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
			aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto">
			<!--<li class="nav-item active">
				<a class="nav-link" href="#">Cadastrar <span class="sr-only">(current)</span></a>
			</li>-->

		</ul>
		<!--<form class="form-inline mt-2 mt-md-0">
			<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>-->
	</div>
</nav>

<main role="main" class="container">
	<div class="jumbotron">
		<h1>CRUD</h1>
		<p class="lead">Exemplo de crud para seleção de cargo de desenvolvedor júnior Simpleshotel.</p>
		<!-- Button trigger modal -->
		<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
			Cadastrar Usuário
		</a>
		<a href="<?= base_url('Welcome/enviarEmail') ?>" type="button" class="btn btn-outline-warning" style="margin-left: 12px;">Enviar para Alberto &raquo;
		</a>
		<a href="<?= base_url('log') ?>" type="button" class="btn btn-secondary" style="margin-left: 12px;">
			Logs &raquo;
		</a>
		<hr>
		<h4 style="text-align: center">Lista de Usuários</h4>
		<form class="form-group"  method="post"  action="<?php echo base_url('') ?>" >
			<table class="table table-bordered tablesorter">
				<?php echo $this->session->flashdata('mensagemCadastro');?>
				<?php echo $this->session->flashdata('mensagemDelete');?>
				<?php echo $this->session->flashdata('mensagemEditar');?>
				<?php echo $this->session->flashdata('mensagemEmail');?>
				<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nome</th>
					<th scope="col">Email</th>
					<th scope="col">Data do Cadastro</th>
				</tr>
				</thead>
				<tbody>
				<?php if ($user){
				foreach ( $user as $usuarios ) { ?>
				<tr>
					<th scope="row"><?= $usuarios->id ?></th>
					<td><?= $usuarios->nome ?></td>
					<td><?= $usuarios->email ?></td>
					<!--<td><?/*= date_format($usuarios->data_cadastro, 'd-m-Y') */?></td>-->

					<td><?= $usuarios->data_cadastro ?></td>
					<td>
						<div class="botaoList">
							<!--<button type="submit" class="btn btn-warning btn-sm">Editar</button>-->
							<!--<button type="submit" class="btn btn-danger btn-sm">Excluir</button>-->
							<a href="<?= base_url('Welcome/editar/' . $usuarios->id) ?>" class="btn btn-warning btn-sm">Editar</a>
							<a href="<?= base_url('Welcome/deletarUser/' . $usuarios->id) ?>" class="btn btn-danger btn-sm">Excluir</a>
						</div>
					</td>
				</tr>
				<?php }
				} ?>
				</tbody>
			</table>
		</form>
	</div>
</main>

<!-- Modal Cadastro -->
<form class="modal fade form form-contact" id="modalCadastro" tabindex="-1" aria-hidden="true" method="post"
	  action="<?php echo base_url('Welcome/cadastrar') ?>" >
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Cadastro</h5>
			</div>
			<div class="modal-body form-group">
				<label for="nomeUser">Nome</label>
				<input type="text" class="form-control" id="nomeUser" name="nomeUser" placeholder="Nome" required>
			</div>
			<div class="modal-body form-group">
				<label for="emailUser">Endereço de Email</label>
				<input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="Email" required>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button type="reset" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</form>


