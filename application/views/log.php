<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!--link cursor para listar logs por classificação-->
<style type="text/css">
	th {
		cursor: pointer;
	}
</style>
<div class="container">
	<div class="form-group">
	<h4 style="text-align: center">Lista de Logs</h4>

	<a href="<?= base_url() ?>" type="button" class="btn btn-primary" >
		Voltar &laquo;
	</a>
</div>
	<form>

		<table class="table tablesorter">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/tablesorter/2.17.4/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
	$('.tablesorter').tablesorter();
</script>

