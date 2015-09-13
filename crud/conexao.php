<?php
	// Conexão do Banco de Dados
	header ('Content-type: text/html; charset=utf-8');

		$servidor = 'localhost';
		$usuario = 'root';
		$senha = 'torah';
		$banco = 'bd_papyrus';

		$conexao = mysqli_connect($servidor, $usuario, $senha);
		
		if($conexao){
			mysqli_select_db($conexao, $banco);
		}else{
			echo '<h1>Falha na conexão. Erro.</h1>';
		}
?>