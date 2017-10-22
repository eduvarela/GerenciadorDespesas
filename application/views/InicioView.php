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
	<div class="container pt-5 col-md-4">
		<div class="card border border-dark bg-light">
			<div class="card-header bg-dark text-white">
				Controle de Acesso
			</div>
			<div class="card-body">
				<form class="form-signin" action="<?=base_url('index.php/Inicio/conectar')?>" method="post" accept-charset="utf-8">
					<div class="input-group mb-2 mb-sm-0">
						<div class="input-group-addon bg-dark text-white"><i class="fa fa-user mr-1" aria-hidden="true"></i>
						</div>
						<input name="Email" type="text" class="form-control border-dark" id="Email" placeholder="Email">
					</div>

					<div class="input-group mb-2 mb-sm-0 mt-2">
						<div  class="input-group-addon bg-dark text-white"><i class="fa fa-key" aria-hidden="true"></i>
						</div>
						<input name="Senha" type="password" class="form-control border border-dark" id="Senha" placeholder="Senha">
					</div>
					<div class="TriSea-technologies-Switch pt-2 pb-2">
						<input id="TriSeaPrimary" name="TriSea1" type="checkbox"/>
						<label for="TriSeaPrimary" class="label-primary"></label> Lembrar-me
					</div>
					<button class="btn btn-lg btn-dark btn-block" type="submit"><i class="fa fa-unlock-alt" aria-hidden="true"></i>
						Conectar</button>
					</form>
				</div>
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
	</body>
	</html>
