<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Estudo</title>
</head>
<body>
	
	<?php
	 // conexão
		$servidor = 'localhost';
		$usuario = 'root';
		$senha = '';

		$conexao = mysqli_connect($servidor, $usuario, $senha);
		
		if($conexao){
			mysqli_select_db($conexao,'bd_teste_estudo');
			echo '<h1>Conexão efetuada com sucesso!</h1>';
		}else{
			echo '<h1>Falha na conexão. Erro.</h1>';
		}

	 // insere dados na tabela
		$nome = $_POST['nome'];
		$senha = sha1($_POST['senha']);
	 	$insere_dados = "INSERT INTO usuario VALUES(NULL, '$nome', '$senha')"; 

	 	mysqli_query($conexao, $insere_dados);

	 	echo '<h1>Usuário:</h1><h2>Nome: '.$nome.' - Senha: '.$senha.' - Foram inseridos com SUCESSO!</h2><br>';

	?>


</body>
</html>