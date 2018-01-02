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
		<ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
			<li class="nav-item col-md-6" style="padding-left: 0px; padding-right: 0px;">
				<a class="nav-link btn-dark border-dark border-right-0 active" style="border-radius: 0 !important;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
			</li>
			<li class="nav-item col-md-6" style="padding-left: 0px; padding-right: 0px;">
				<a class="nav-link btn-dark border-dark border-left-0" style="border-radius: 0 !important;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Cadastro</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active border border-dark border-top-0" id="home" role="tabpanel" aria-labelledby="home-tab">
				<form class="form-signin" action="<?=base_url('index.php/Inicio/conectar')?>" method="post" accept-charset="utf-8">
					<div class="input-group mb-2 mb-sm-0">
						<div class="input-group-addon bg-dark text-white ml-2 mt-2"><i class="fa fa-user mr-1" aria-hidden="true"></i>
						</div>
						<input name="Email" type="text" class="form-control border-dark mt-2 mr-2" id="Email" placeholder="Email">
					</div>

					<div class="input-group mb-2 mb-sm-0 mt-2">
						<div  class="input-group-addon bg-dark text-white ml-2"><i class="fa fa-key" aria-hidden="true"></i>
						</div>
						<input name="Senha" type="password" class="form-control border border-dark mr-2" id="Senha" placeholder="Senha">
					</div>
					<div class="Checkbox-Switch pt-2 pb-2 pl-3">
						<input id="TriSeaPrimary" name="TriSea1" type="checkbox"/>
						<label for="TriSeaPrimary" class="label-primary"></label> Lembrar-me
					</div>
					<button class="btn btn-lg btn-dark btn-block" style="border-radius: 0 !important;" type="submit"><i class="fa fa-unlock-alt" aria-hidden="true"></i>
					Conectar</button>
				</form>
			</div>
			<div class="tab-pane fade border border-dark border-top-0" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				<form class="form-signin" action="<?=base_url('index.php/Inicio/conectar')?>" method="post" accept-charset="utf-8">
					<div class="input-group mb-2 mb-sm-0">
						<div class="input-group-addon bg-dark text-white ml-2 mt-2"><i class="fa fa-font" aria-hidden="true"></i>
						</div>
						<input name="Nome" type="text" class="form-control border-dark mt-2 mr-2" id="NomeCadastro" placeholder="Nome">
					</div>
					<div class="input-group mb-2 mb-sm-0">
						<div class="input-group-addon bg-dark text-white ml-2 mt-2"><i class="fa fa-user mr-1" aria-hidden="true"></i>
						</div>
						<input name="Email" type="text" class="form-control border-dark mt-2 mr-2" id="EmailCadastro" placeholder="Email">
					</div>
					<div class="input-group mb-2 mb-sm-0 mt-2">
						<div  class="input-group-addon bg-dark text-white ml-2"><i class="fa fa-key" aria-hidden="true"></i>
						</div>
						<input name="Senha" type="password" class="form-control border border-dark mr-2" id="SenhaCadastro" placeholder="Senha">
					</div>
					<div class="input-group mb-2 mb-sm-0 mt-2 pb-3">
						<div  class="input-group-addon bg-dark text-white ml-2"><i class="fa fa-key" aria-hidden="true"></i>
						</div>
						<input name="RepetirSenha" type="password" class="form-control border border-dark mr-2" id="RepetirSenhaCadastro" placeholder="Repetir Senha">
					</div>
					<button class="btn btn-lg btn-dark btn-block" style="border-radius: 0 !important;" type="submit"><i class="fa fa-user-plus" aria-hidden="true"></i>
					Cadastrar</button>
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
