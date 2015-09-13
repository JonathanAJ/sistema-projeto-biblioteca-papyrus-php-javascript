<?php 
	include "conexao.php";
	$id = $_POST['id'];
	$tipo = $_POST['tipo'];

	if($tipo=='delete-titulo'){
		$sql = "DELETE FROM exemplar WHERE titulo_id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
			echo $response = mysqli_error($conexao);
		}else{
			$sql = "DELETE FROM titulo WHERE id='$id'";
			if(!mysqli_query($conexao, UTF8_decode($sql))){
				echo $response = mysqli_error($conexao);
			}else{
				$response = "OK1";
				echo $response;
			}
			$response = " - OK2";
			echo $response;
		}

	}else if($tipo=='delete-exemplar'){
		$sql = "DELETE FROM exemplar WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
			echo $response = mysqli_error($conexao);
		}else{
			$response = "OK delete exemplar";
			echo $response;
		}

	}else if($tipo=='delete-leitor'){
		$sql = "DELETE FROM leitor WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
			echo $response = mysqli_error($conexao);
		}else{
			$response = "OK delete leitor";
			echo $response;
		}

	}else if($tipo=='delete-multa'){
		$sql = "DELETE FROM multa WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
			echo $response = mysqli_error($conexao);
		}else{
			$response = "OK delete multa";
			echo $response;
		}
	}else if($tipo=='delete-tempo'){
		$sql = "DELETE FROM tipo_emprestimo WHERE id='$id'";

		if(!mysqli_query($conexao, UTF8_decode($sql))){
			echo $response = mysqli_error($conexao);
		}else{
			$response = "OK delete tempo";
			echo $response;
		}
	}


	mysqli_close($conexao);
?>