<?php 
	include "conexao.php";
	
	$tipo = $_POST['tipo'];

	if($tipo=='titulo'){
		$titulo = $_POST['titulo'];
		$tipo_exemplar = $_POST['tipo_exemplar'];
		$autor = $_POST['autor'];
		$descricao = $_POST['descricao'];
		
		$sql = "INSERT INTO titulo (titulo, tipo_exemplar, autor, descricao)
						    VALUES ('$titulo', '$tipo_exemplar', '$autor', '$descricao')";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
			echo $response = mysqli_error($conexao);
		}else{
			echo $response = "OK";
		}
	}
	else if($tipo=='exemplar'){
		$status = 1;
		$chamada = $_POST['chamada'];
		$isbn = $_POST['isbn'];
		$edicao = $_POST['edicao'];
		$volume = $_POST['volume'];
		$ano = $_POST['ano'];
		$editora = $_POST['editora'];
		$cidade = $_POST['cidade'];
		$descricao_fisica = $_POST['descricao_fisica'];
		$titulo_id = $_POST['titulo_id'];
		$qntd = $_POST['qntd'];

		$sql = "INSERT INTO exemplar (status, chamada, isbn, edicao, volume, ano, editora, cidade, descricao_fisica, titulo_id)
					          VALUES ('$status', '$chamada', '$isbn', '$edicao', '$volume', '$ano', '$editora', '$cidade', '$descricao_fisica', '$titulo_id')";
		while($qntd>0){
			if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
			}else{
				echo $response = "OK";
			}
			$qntd--;
		}
	}
	else if($tipo=='leitor'){

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

		$sql = "INSERT INTO leitor (nome, email, cpf, rg, nascimento, sexo, cidade, cep, bairro, rua, num, comp)
					          VALUES ('$nome', '$email', '$cpf', '$rg', '$nascimento', '$sexo', '$cidade', '$cep', '$bairro', '$rua', '$num', '$comp')";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}
	}
	else if($tipo=='multa'){

		$nome = $_POST['nome'];
		$valor = $_POST['valor'];

		$sql = "INSERT INTO multa (nome, valor)
					          VALUES ('$nome', '$valor')";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}
	}
	else if($tipo=='tempo'){

		$nome = $_POST['nome'];
		$dias = $_POST['dias'];

		$sql = "INSERT INTO tipo_emprestimo (nome, dias)
					          VALUES ('$nome', '$dias')";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
		}else{
				echo $response = "OK";
		}
	}
	else if($tipo=='reserva'){

		$data_emprestimo = implode("-",array_reverse(explode("/",$_POST['data_emprestimo'])));
		$data_entrega = implode("-",array_reverse(explode("/",$_POST['data_entrega'])));
		$exemplar_id = $_POST['exemplar_id'];
		$leitor_id = $_POST['leitor_id'];
		$tipo_emprestimo_id = $_POST['tipo_emprestimo_id'];
		$multa_id = $_POST['multa_id'];

		$sql = "INSERT INTO reserva (data_emprestimo, data_entrega, exemplar_id, leitor_id, tipo_emprestimo_id, multa_id)
					          VALUES ('$data_emprestimo', '$data_entrega', '$exemplar_id', '$leitor_id', '$tipo_emprestimo_id', '$multa_id')";

		if(!mysqli_query($conexao, UTF8_decode($sql))){

				echo $response = mysqli_error($conexao);
		}
		else{

			echo $response = "OK 1";
				
			$sql = "UPDATE exemplar SET status='0'
					WHERE id='$exemplar_id'";
			
			if(!mysqli_query($conexao, UTF8_decode($sql))){
				
				echo $response = mysqli_error($conexao);
			}
			else{
					echo $response = "OK 2";
			}
		}
	}

	mysqli_close($conexao);
?>