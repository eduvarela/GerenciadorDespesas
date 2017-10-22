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
         <i class="fa fa-user" aria-hidden="true"></i> Usuario
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
						<a class="nav-link btn-light" href="#">Fornecedores</a>
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
					<table id="despesas" class="table table-striped">
						<thead>
							<tr>
								<th onclick="sortTable(0)" class="btn-light hadcursor">#</th>
								<th onclick="sortTable(1)" class="btn-light hadcursor">Header</th>
								<th onclick="sortTable(2)" class="btn-light hadcursor">Header</th>
								<th onclick="sortTable(3)" class="btn-light hadcursor">Header</th>
								<th onclick="sortTable(4)" class="btn-light hadcursor">Header</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1,001</td>
								<td>Lorem</td>
								<td>ipsum</td>
								<td>dolor</td>
								<td>sit</td>
							</tr>
							<tr>
								<td>1,002</td>
								<td>amet</td>
								<td>consectetur</td>
								<td>adipiscing</td>
								<td>elit</td>
							</tr>
							<tr>
								<td>1,003</td>
								<td>Integer</td>
								<td>nec</td>
								<td>odio</td>
								<td>Praesent</td>
							</tr>
							<tr>
								<td>1,003</td>
								<td>libero</td>
								<td>Sed</td>
								<td>cursus</td>
								<td>ante</td>
							</tr>
							<tr>
								<td>1,004</td>
								<td>dapibus</td>
								<td>diam</td>
								<td>Sed</td>
								<td>nisi</td>
							</tr>
							<tr>
								<td>1,005</td>
								<td>Nulla</td>
								<td>quis</td>
								<td>sem</td>
								<td>at</td>
							</tr>
							<tr>
								<td>1,006</td>
								<td>nibh</td>
								<td>elementum</td>
								<td>imperdiet</td>
								<td>Duis</td>
							</tr>
							<tr>
								<td>1,007</td>
								<td>sagittis</td>
								<td>ipsum</td>
								<td>Praesent</td>
								<td>mauris</td>
							</tr>
							<tr>
								<td>1,008</td>
								<td>Fusce</td>
								<td>nec</td>
								<td>tellus</td>
								<td>sed</td>
							</tr>
							<tr>
								<td>1,009</td>
								<td>augue</td>
								<td>semper</td>
								<td>porta</td>
								<td>Mauris</td>
							</tr>
							<tr>
								<td>1,010</td>
								<td>massa</td>
								<td>Vestibulum</td>
								<td>lacinia</td>
								<td>arcu</td>
							</tr>
							<tr>
								<td>1,011</td>
								<td>eget</td>
								<td>nulla</td>
								<td>Class</td>
								<td>aptent</td>
							</tr>
							<tr>
								<td>1,012</td>
								<td>taciti</td>
								<td>sociosqu</td>
								<td>ad</td>
								<td>litora</td>
							</tr>
							<tr>
								<td>1,013</td>
								<td>torquent</td>
								<td>per</td>
								<td>conubia</td>
								<td>nostra</td>
							</tr>
							<tr>
								<td>1,014</td>
								<td>per</td>
								<td>inceptos</td>
								<td>himenaeos</td>
								<td>Curabitur</td>
							</tr>
							<tr>
								<td>1,015</td>
								<td>sodales</td>
								<td>ligula</td>
								<td>in</td>
								<td>libero</td>
							</tr>
						</tbody>
					</table>
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
