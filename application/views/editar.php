<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Modal Editar -->
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h4 class="display-4" style="text-align: center;">Atualizar Usuário</h4>

		<form class="form form-contact" id="modalEditar" method="post" action="<?php echo base_url('Welcome/editarUser/' .$id) ?>" >
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<div class="modal-body form-group">
						<label for="nomeUser">Nome</label>
						<input type="text" class="form-control" value="<?= $nome ?>" id="nomeUser" name="nomeUser" placeholder="Nome" required>
					</div>
					<div class="modal-body form-group">
						<label for="emailUser">Endereço de Email</label>
						<input type="email" class="form-control" value="<?= $email ?>" id="emailUser" name="emailUser" placeholder="Email" required>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Salvar</button>
						<a href="<?= base_url() ?>" class="btn btn-warning ">Cancelar</a>
					</div>
				</div>
			</div>
		</form>

	</div>
</div>

