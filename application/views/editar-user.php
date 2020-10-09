<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->load->view('commos/header');
?>

<!-- Modal Editar -->
<form class="modal fade form form-contact" id="modalEditar" tabindex="-1" aria-hidden="true" method="post"
	  action="<?php echo base_url('Welcome/editarUser/'. $user->id) ?>" >
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Cadastro</h5>
			</div>
			<div class="modal-body form-group">
				<label for="nomeUser">Nome</label>
				<input type="text" class="form-control" value="<?= $user->nome ?>" id="nomeUser" name="nomeUser" placeholder="Nome" required>
			</div>
			<div class="modal-body form-group">
				<label for="emailUser">Endereço de Email</label>
				<input type="email" class="form-control" value="<?= $user->email ?>" id="emailUser" name="emailUser" placeholder="Email" required>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button type="reset" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</form>

<?php
$this->load->view('commos/footer');
?>
