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
			<a class="navbar-brand" href="#"><img src="<?php echo base_url("recursos/images/favicon.png");?>" width="30" height="30"> Gerenciador de Despesas</a>
			<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
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

			<main id="conteudoDinamico" role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">

			</main>
		</div>
	</div>
	<!-- Scripts -->
	<script src="<?php echo base_url("recursos/js/jquery-3.2.1.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/popper.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/bootstrap.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/bootstrap-notify.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/bootstrap-datepicker.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/bootstrap-datepicker.pt-BR.min.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/holder.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/recursos.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/jquery.mask.js");?>"></script>
	<script src="<?php echo base_url("recursos/js/Chart.min.js");?>"></script>

	<script>
		$(document).ready(function(){
			$("#conteudoDinamico").load("<?php echo base_url(); ?>index.php/PainelGeral/carregarPainelAsync");
		});
	</script>
</body>
</html>
