<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container">
	<div class="form-group">
	<h4 style="text-align: center">Lista de Logs</h4>

	<a href="<?= base_url() ?>" type="button" class="btn btn-outline-primary" >
		Voltar &laquo;
	</a>
</div>
	<form>

		<table class="table">
			<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Descrição</th>
				<th scope="col">Ação</th>
				<th scope="col">Data e Hora</th>
			</tr>
			</thead>
			<tbody>
			<?php if ($logs) {
				foreach ($logs as $log) { ?>
					<tr>
						<th scope="row"><?=$log->id ?></th>
						<td><?=$log->descricao ?></td>
						<td><?=$log->tipo ?></td>
						<td><?=$log->data ?></td>
					</tr>
			<?php }
				} ?>

			</tbody>
		</table>

	</form>
</div>
