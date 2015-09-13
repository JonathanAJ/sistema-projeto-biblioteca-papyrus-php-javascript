<?php 
	include "conexao.php";
	
	$tipo = $_POST['tipo'];

	if($tipo=='titulo'){
	
		$id = $_POST['id'];
		$titulo = $_POST['titulo'];
		$tipo_exemplar = $_POST['tipo_exemplar'];
		$autor = $_POST['autor'];
		$descricao = $_POST['descricao'];

		$sql = "UPDATE titulo SET titulo='$titulo', autor='$autor', tipo_exemplar='$tipo_exemplar', descricao='$descricao' WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}

	}else if($tipo=='exemplar'){
	
		$id = $_POST['id'];
		$chamada = $_POST['chamada'];
		$isbn = $_POST['isbn'];
		$volume = $_POST['volume'];
		$edicao = $_POST['edicao'];
		$ano = $_POST['ano'];
		$editora = $_POST['editora'];
		$cidade = $_POST['cidade'];
		$descricao_fisica = $_POST['descricao_fisica'];

		$sql = "UPDATE exemplar SET chamada='$chamada', isbn='$isbn', volume='$volume', edicao='$edicao', ano='$ano',
									editora='$editora', cidade='$cidade', descricao_fisica='$descricao_fisica'
								WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}

	}else if($tipo=='leitor'){
	
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$nascimento = implode("-",array_reverse(explode("/",$_POST['nascimento'])));
		$sexo = $_POST['sexo'];
		$cidade = $_POST['cidade'];
		$cep = $_POST['cep'];
		$bairro = $_POST['bairro'];
		$rua = $_POST['rua'];
		$num = $_POST['num'];
		$comp = $_POST['comp'];

		$sql = "UPDATE leitor SET nome='$nome', email='$email', cpf='$cpf', rg='$rg', nascimento='$nascimento',
								  sexo='$sexo', cidade='$cidade', cep='$cep', bairro='$bairro', rua='$rua', num='$num', comp='$comp'
							  WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}

	}else if($tipo=='multa'){
	
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$valor = $_POST['valor'];

		$sql = "UPDATE multa SET nome='$nome', valor='$valor'
							  WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}

	}else if($tipo=='tempo'){
	
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$dias = $_POST['dias'];

		$sql = "UPDATE tipo_emprestimo SET nome='$nome', dias='$dias'
							  WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}

	}

	mysqli_close($conexao);
?>