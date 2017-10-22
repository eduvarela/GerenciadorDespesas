<!DOCTYPE html>
<html lang="pt-br">
<head>

	<title>Gerenciador de Despesas</title>

	<script type="text/javascript">
		var APP_ROOT = "<?php echo base_url(); ?>";
	</script>

	<!-- Recursos -->
	<link rel="<?php echo base_url("recursos/images/favicon.png");?>" type="image/x-icon" rel="icon">
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url("recursos/images/favicon.png");?>"/>
	<link rel="stylesheet" href="<?php echo base_url("recursos/css/font-awesome.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("recursos/css/bootstrap.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("recursos/css/recursos.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("recursos/css/bootstrap-datepicker3.css");?>">
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand" href="#"><img src="<?php echo base_url("recursos/images/favicon.png");?>" width="20" height="20"> Gerenciador de Despesas</a>
			<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Painel</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Informações</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Contato</a>
					</li>
				</ul>
				<div class="btn-group">
					<button type="button" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user" aria-hidden="true"></i> <?php echo $this->data['Usuario']['Nome']; ?>
					</button>
					<div class="dropdown-menu dropdown-menu-right" style="right:0;left:auto;">
						<button id="editarPerfil" class="dropdown-item text-dark" type="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Meu Perfil</button>
						<a href="<?php echo base_url('index.php/Painel/desconectar'); ?>"><button class="dropdown-item text-dark" type="button"><i class="fa fa-sign-out" aria-hidden="true"></i>  Sair</button></a>
					</div>
				</div>
			</div>
		</nav>
	</header>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
				<ul class="nav nav-pills flex-column">
					<li class="nav-item">
						<a class="nav-link btn-dark" href="#">Geral</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn-light" href="#">Despesas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn-light" href="#">Favorecidos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn-light" href="#">Formas de Pagamento</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn-light" href="#">Categorias</a>
					</li>
				</ul>
			</nav>

			<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
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
								<button type="button" class="close closeEnviarFoto" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group row pl-4 pr-1">
									<select class="form-control col-md-5 mr-2" id="exampleFormControlSelect1">
										<option>option 1</option>
										<option>option 2</option>
										<option>option 3</option>
										<option>option 4</option>
										<option>option 5</option>
									</select>
											<select class="form-control col-md-6" id="exampleFormControlSelect1">
										<option>option 1</option>
										<option>option 2</option>
										<option>option 3</option>
										<option>option 4</option>
										<option>option 5</option>
									</select>
								</div>
								<div class="form-group col-md-12 row pl-4 pr-1">
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
								</div>
								<div class="form-group row pl-4 pr-1">
									<input type="email" class="form-control col-md-5 mr-2" id="exampleInputEmail1" placeholder="Enter email">
									<input type="email" class="form-control col-md-6" id="exampleInputEmail1" placeholder="Enter email">
								</div>
							</div>
							<div class="modal-footer">
								FOOTER
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<!-- Scripts -->
	<script src="<?php echo base_url("recursos/js/jquery-3.2.1.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/popper.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/bootstrap.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/bootstrap-datepicker.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/bootstrap-datepicker.pt-BR.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/holder.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/recursos.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/jquery.mask.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/Chart.min.js");?>"></script>

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

</script>
</body>
</html>
