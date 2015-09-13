<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Papyrus - Sistema Integrado de Bibliotecas</title>
	<!-- Chamada do jQuery -->
	<script language='javascript' src='js/jquery-2.1.4.min.js'></script>
	<!-- Chamada Mask com jQuery -->
	<script language='javascript' src='js/jquery.maskedinput.min.js'></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap-3.3.5/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="bootstrap-3.3.5/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="bootstrap-3.3.5/js/bootstrap.min.js"></script>
	<!-- Bootstrap Select CSS -->
	<link rel="stylesheet" href="style/bootstrap-select.min.css">
	<!-- Bootstrap Select JS -->
	<script src="js/bootstrap-select.min.js"></script>
	<!-- Chamada do meu estilo -->
	<link rel="stylesheet" href="style/estilo.css">
	<!-- Chamada do meu script -->
	<script language="JavaScript" src="js/script.js"></script>
	<!-- Viewport do documento - Responsividade -->
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="container">
		<header id="cabecalho" class="row">
			<div id="menu-principal">
				<nav class="navbar navbar-default navbar-fixed-top">
				  <div class="container">
					  <div class="row">

					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-desktop" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
        				  <img alt="logotipo" style="margin-right: 50px;" src="img/logo.png">
					    </div>

					    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="menu-desktop">
					      <ul class="nav navbar-nav">
					      	<?php
					      		$pagina = $_SERVER['PHP_SELF'];
					      		$pagina = substr(strrchr($pagina, "/"), 1);
					      	?>
					        <li class="<?php if($pagina=='index.php'||$pagina=='acervo.php'): echo 'active'; endif;?>">
					        	<a href="./index.php">Títulos <span class="sr-only">(current)</span></a>
					        </li>
					        <li class="<?php if($pagina=='leitores.php'): echo 'active'; endif;?>">
					        	<a href="./leitores.php">Leitores</a>
					        </li>
					        <li class="<?php if($pagina=='historicos.php'): echo 'active'; endif;?>">
					        	<a href="./historicos.php">Históricos</a>
					        </li>
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrador <span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="#" id="bt-multa" data-toggle="modal" rel="modal" data-target="#modal-admin">Valor de Multa</a></li>
					            <li><a href="#" id="bt-tempo" data-toggle="modal" rel="modal" data-target="#modal-admin">Tempo de Empréstimo</a></li>
					          </ul>
					        </li>
					      </ul>
					      <ul class="nav navbar-nav navbar-right">
					        <li><a href="#">Notificações <span class="badge">7</span></a></li>
					      </ul>
					    </div><!-- /.navbar-collapse -->
					  </div>
				  </div>
				</nav>
			</div>
			<div id="logo">
				<a href="./index.php"><h2>Papyrus <small>Sistema Integrado de Bibliotecas</small></h2></a>
			</div>
		</header>