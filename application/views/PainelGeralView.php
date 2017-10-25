				<h1>Painel Geral</h1>

				<section class="row text-center placeholders">
					<div class="col-6 col-sm-3 placeholder">
						<canvas id="myChart" width="100" height="100"></canvas>
						<h4>Label</h4>
						<div class="text-muted">Something else</div>
					</div>
					<div class="col-6 col-sm-3 placeholder">
						<canvas id="myChart2" width="100" height="100"></canvas>
						<h4>Label</h4>
						<span class="text-muted">Something else</span>
					</div>
					<div class="col-6 col-sm-3 placeholder">
						<canvas id="myChart3" width="100" height="100"></canvas>
						<h4>Label</h4>
						<span class="text-muted">Something else</span>
					</div>
					<div class="col-6 col-sm-3 placeholder">
						<canvas id="myChart4" width="100" height="100"></canvas>
						<h4>Label</h4>
						<span class="text-muted">Something else</span>
					</div>
				</section>

				<h2>Despesas</h2>
				<div class="table-responsive">
					<table id="despesas" class="table  table-hover">
						<thead>
							<tr>
								<th onclick="sortTable(0)" class="btn-light hadcursor">Categoria</th>
								<th onclick="sortTable(1)" class="btn-light hadcursor">Favorecido</th>
								<th onclick="sortTable(2)" class="btn-light hadcursor">Status</th>
								<th onclick="sortTable(3)" class="btn-light hadcursor">Valor</th>
								<th onclick="sortTable(4)" class="btn-light hadcursor">Vencimento</th>

							</tr>
						</thead>
						<tbody>
							<?php foreach($this->data['Despesas'] as $despesa){ ?>
							<tr>
								<td><?php echo $despesa['Categoria']; ?></td>
								<td><?php echo $despesa['Favorecido']; ?></td>
								<td><?php echo $despesa['StatusDespesa']; ?></td>
								<td>R$ <?php echo $despesa['Valor']; ?></td>
								<td><?php echo $despesa['DataVencimento']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<button class="btn btn-danger rounded-circle add-button" data-toggle="modal" data-target="#modalAvatar">
					<i class="fa fa-plus" aria-hidden="true"></i>
				</button>

				<div class="modal fade" id="modalAvatar" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog" style="margin-top: 15%;" role="document">
						<div class="modal-content">
							<div class="modal-header bg-dark text-white">
								<h5 class="modal-title" id="modalAvatarLabel">Adicionar Despesa</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group row pl-4 pr-1">
									<select class="form-control col-md-5 mr-2" id="favorecidoSelect">
										<option>Selecione o Favorecido</option>
										<<?php foreach($this->data['Favorecidos'] as $favorecido){ ?>
										<option id="<?php echo $favorecido['IdFavorecido']; ?>"><?php echo $favorecido['Nome']; ?></option>
										<?php } ?>
									</select>
									<select class="form-control col-md-6" id="formaPagamentoSelect">
										<option>Selecione a forma de pagamento</option>
										<<?php foreach($this->data['FormasPagamento'] as $formapagamento){ ?>
										<option id="<?php echo $formapagamento['IdFormaPagamento']; ?>"><?php echo $formapagamento['Nome']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-md-12 row pl-4 pr-1">
									<input type="text" class="form-control" id="descricaoInput" placeholder="Descrição">
								</div>
								

								<div class="row">
									<div class="form-group row ml-4">
									<input type="text" class="form-control col-md-14 mr-2" id="exampleInputEmail1" placeholder="Valor">
								</div>
								<div class="col-md-6 form-group input-group date container">
								<input name="DataVencimento" id="DataVencimento" required="required" placeholder="Vencimento" type="text" maxlength="10" class="form-control"><span class="input-group-addon btn-dark"><i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
							</div>
							</div>


							<div class="form-group col-md-12 row pl-4 pr-1">
								<div class="Checkbox-Switch pt-2 pb-2">
									<input id="TriSeaPrimary" name="TriSea1" type="checkbox"/>
									<label for="TriSeaPrimary" class="label-primary"></label> Pago
								</div>								
							</div>
						</div>
						<div class="modal-footer bg-dark">
							<button class="btn btn-success">Adicionar</button><button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var ctx2 = document.getElementById("myChart2").getContext('2d');
				var ctx3 = document.getElementById("myChart3").getContext('2d');
				var ctx4 = document.getElementById("myChart4").getContext('2d');

				var myChart = new Chart(ctx, {
					type: 'pie',
					data: {
						datasets: [{
							data: [10, 20, 30],
							backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							],
							borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							],
							borderWidth: 1
						}],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
    'Red',
    'Yellow',
    'Blue'
    ],
},
options: {
	legend: {
		display: false
	}
}
});

				var myChart = new Chart(ctx2, {
					type: 'pie',
					data: {
						datasets: [{
							data: [10, 20, 30],
							backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							],
							borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							],
							borderWidth: 1
						}],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
    'Red',
    'Yellow',
    'Blue'
    ],
},
options: {
	legend: {
		display: false
	}
}
});

				var myChart2 = new Chart(ctx3, {
					type: 'pie',
					data: {
						datasets: [{
							data: [10, 20, 30],
							backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							],
							borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							],
							borderWidth: 1
						}],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
    'Red',
    'Yellow',
    'Blue'
    ],
},
options: {
	legend: {
		display: false
	}
}
});

				var myChart = new Chart(ctx4, {
					type: 'pie',
					data: {
						datasets: [{
							data: [10, 20, 30],
							backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							],
							borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							],
							borderWidth: 1
						}],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
    'Red',
    'Yellow',
    'Blue'
    ],
},
options: {
	legend: {
		display: false
	}
}
});
   // Calendario para campos de data
   $('.input-group.date').datepicker({
   	format: "dd/mm/yyyy",
   	weekStart: 1,
   	clearBtn: true,
   	language: "pt-BR",
   	daysOfWeekHighlighted: "0,6",
   	toggleActive: true
   });

</script>