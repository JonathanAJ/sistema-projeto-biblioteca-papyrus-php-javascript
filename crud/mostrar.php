<?php 
		//precisamos chamar esta página para realizarmos as queries com o banco                 
		include 'conexao.php';
		// limite o número por página
		$limite = 6;
		// página default
		$pagina_atual = 1;
		if (empty($_GET['pagina'])){
        	$_GET['pagina'] = 1;
    	}
		if (!empty($_GET['pagina'])){
        	$pagina_atual = (int) $_GET['pagina'];
    	}
		$offset = ($limite * $pagina_atual) - $limite;

    	// Campo de pesquisa
		if (empty($_GET['pesquisa'])){
	       	$_GET['pesquisa'] = false;
	    }
    	$pesquisa = utf8_decode($_GET['pesquisa']) ;

		// Função que mostra o total de elementos
    	function mostraTotal($tabela){
    		global $conexao;

	    	$select = "SELECT * FROM $tabela";                 
			$result = mysqli_query($conexao, $select);
			$total = mysqli_num_rows($result);

	    	return $total;
    	}

    	// Função que mostra a paginação da tabela
    	function mostraPag($titulo, $pagina){
    		global $conexao, $limite, $offset;
			$select = "SELECT * FROM $titulo";                 
			$result = mysqli_query($conexao, $select);
			$total = mysqli_num_rows($result);
	    	$numero_de_paginas = ceil($total/$limite);

	    	$pagin = '';
	    	$cont = $_GET['pagina'];
	    		// condicional para fazer a contagem diferenciada se atual for maior/igual que 6
	    		if($cont>=6):
	    			// contagem diferenciada começando do atual-5 até atual+4, ficando = 10
			    	for($i=$cont-5; $i<=$cont+4; $i++){
			    		// condicional para colocar a classe ativa
			    		if($_GET['pagina']==$i){
			    			$pagin = $pagin.'<li class="active"><a href="'.$pagina.'?pagina='.$i.'">'.$i.'</a></li>';
			    		}else{
			    			$pagin = $pagin.'<li><a href="'.$pagina.'?pagina='.$i.'">'.$i.'</a></li>';
			    		}
			    		//quebra o loop se o contador for igual ao numero de paginas
			    		if($i==$numero_de_paginas):
			    			break;
			    		endif;
			    	}
		    	else:
		    		/* contagem inicial: se tiver mais que 10 páginas,
		    		   o contador vai até a 10ª para não deixar páginas infinitas
		    		*/
	    			if($numero_de_paginas>=10){
	    				$numero_de_paginas = 10;
	    			}
	    			// inicialmente o a contagem vai até o número de páginas
			    	for($i=1; $i<=$numero_de_paginas; $i++){
			    		// condicional para colocar a classe ativa
			    		if($_GET['pagina']==$i){
			    			$pagin = $pagin.'<li class="active"><a href="'.$pagina.'?pagina='.$i.'">'.$i.'</a></li>';
			    		}else{
			    			$pagin = $pagin.'<li><a href="'.$pagina.'?pagina='.$i.'">'.$i.'</a></li>';
			    		}
			    	}
		    	endif;
			    // restaura o valor original da variavel 
    			$numero_de_paginas = ceil($total/$limite);
		    	// se houver + que 10 páginas, coloque o botão Mais
		    	if($numero_de_paginas>10):
	    			echo $pagin.'<li><a href="'.$pagina.'?pagina='.$i.'">Mais &raquo;</a></li>';
	    		else:
	    			echo $pagin;
	    		endif;
    	}


    	// Mostra a tabela de tipos de multas
    	function tabelaMulta(){
    		global $conexao;

			$select = "SELECT * FROM multa";                 
			$result = mysqli_query($conexao, $select);
    		//se vazio
			$numRow = mysqli_num_rows($result);
			if($numRow==0){
			?>
			
				<tr class='row-tabela row'>
					<td class='col-vazio col-md-12' colspan="5">
						<p class="text-center">Ainda não há multas</p>
					</td> 
				</tr>
			<?php
			}

			//resultado do select
			//Enquanto existir usuários no banco ele insere uma nova linha e exibe os dados
			while ($row = mysqli_fetch_assoc($result)) {               
				$id = $row['id'];
				$nome = utf8_encode($row['nome']);
				$valor = utf8_encode($row['valor']);

			?> 
				<tr class='row-tabela row'>
					 <!-- Hiddens -->
					 <input type='hidden' class="hide-id" value='<?php echo $id ?>'/>
					 <input type='hidden' class="hide-nome" value='<?php echo $nome ?>'/>
					 <input type='hidden' class="hide-valor" value='<?php echo $valor ?>'/>
					<!-- inicio -->
					 <td class='col-nome col-md-4'><?php echo $nome ?></td>               
					 <td class='col-valor col-md-4 hidden-sm hidden-xs'>R$ <?php echo $valor ?></td>
					 <td class='col-acoes col-md-4'>
					 	<a id='bt-update-multa' class='btn btn-primary btn-xs' data-toggle='modal' rel='modal' data-tooltip='true' title="Editar Multa" data-target='#modal-admin2' role='button'>
					 		<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> 
					 	</a>
					 	<a id='bt-delete-multa' class='btn btn-danger btn-xs' data-toggle='modal' rel='modal' data-tooltip='true' title="Deletar Multa" data-target='#modal-admin2' role='button'>
					 		<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> 
					 	</a>
					 </td>
				</tr>
			<?php
			}
    	}

    	// Mostra a tabela de tipos de multas
    	function tabelaTempo(){
    		global $conexao;

			$select = "SELECT * FROM tipo_emprestimo";                 
			$result = mysqli_query($conexao, $select);
    		//se vazio
			$numRow = mysqli_num_rows($result);
			if($numRow==0){
			?>
			
				<tr class='row-tabela row'>
					<td class='col-vazio col-md-12' colspan="5">
						<p class="text-center">Ainda não há tempos de empréstimos</p>
					</td> 
				</tr>
			<?php
			}

			//resultado do select
			//Enquanto existir usuários no banco ele insere uma nova linha e exibe os dados
			while ($row = mysqli_fetch_assoc($result)) {               
				$id = $row['id'];
				$nome = utf8_encode($row['nome']);
				$dias = utf8_encode($row['dias']);

			?> 
				<tr class='row-tabela row'>
					 <!-- Hiddens -->
					 <input type='hidden' class="hide-id" value='<?php echo $id ?>'/>
					 <input type='hidden' class="hide-nome" value='<?php echo $nome ?>'/>
					 <input type='hidden' class="hide-dias" value='<?php echo $dias ?>'/>
					<!-- inicio -->
					 <td class='col-nome col-md-4'><?php echo $nome ?></td>               
					 <td class='col-dias col-md-4 hidden-sm hidden-xs'><?php echo $dias ?></td>
					 <td class='col-acoes col-md-4'>
					 	<a id='bt-update-tempo' class='btn btn-primary btn-xs' data-toggle='modal' rel='modal' data-tooltip='true' title="Editar Tempo" data-target='#modal-admin2' role='button'>
					 		<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> 
					 	</a>
					 	<a id='bt-delete-tempo' class='btn btn-danger btn-xs' data-toggle='modal' rel='modal' data-tooltip='true' title="Deletar Tempo" data-target='#modal-admin2' role='button'>
					 		<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> 
					 	</a>
					 </td>
				</tr>
			<?php
			}
    	}

    	// Mostra a tabela de títulos cadastrados
    	function tabelaTitulos(){
    		global $conexao, $limite, $offset, $pesquisa;

	    	if($pesquisa!=false){

		    	$select = "SELECT * FROM titulo WHERE titulo LIKE '%$pesquisa%'";              
				$result = mysqli_query($conexao, $select);
    		
    		}else{
				// Select * traz todos os usuários cadastrados na tabela
				// Order By ordena por ASC - nome ascendente
				// Limit limita o nº de linhas retornadas e Offset é o início da contagem
				$select = "SELECT * FROM titulo ORDER BY titulo ASC LIMIT $limite OFFSET $offset";                 
				$result = mysqli_query($conexao, $select);
    		}

			//resultado do select
			//Enquanto existir usuários no banco ele insere uma nova linha e exibe os dados
			while ($row = mysqli_fetch_assoc($result)) {                     
				$id = $row['id'];                     
				$titulo = utf8_encode($row['titulo']);
				$autor = utf8_encode($row['autor']);
				$tipo_exemplar = utf8_encode($row['tipo_exemplar']);
				$descricao = utf8_encode($row['descricao']);

				$selectRow = "SELECT * FROM exemplar WHERE titulo_id='$id'";
				$resultRow = mysqli_query($conexao, $selectRow);
				$numRow = mysqli_num_rows($resultRow);
			?> 
				<tr class='row-tabela row'>
					 <!-- Hiddens -->
					 <input type='hidden' class="hide-id" value='<?php echo $id ?>'/>
					 <input type='hidden' class="hide-titulo" value='<?php echo $titulo ?>'/>
					 <input type='hidden' class="hide-autor" value='<?php echo $autor ?>'/>
					 <input type='hidden' class="hide-tipo" value='<?php echo $tipo_exemplar ?>'/>
					 <input type='hidden' class="hide-descricao" value='<?php echo $descricao ?>'/>
					<!-- inicio -->
					 <td class='col-titulo col-md-5'><?php echo $titulo ?></td>               
					 <td class='col-autor col-md-3 hidden-sm hidden-xs'><?php echo $autor ?></td>
					 <td class='col-acervo col-md-2'>
					 	<a id='bt-acervo' class='btn btn-default' href="./acervo.php?titulo_id=<?php echo $id ?>" role='button'>
					 		Ver Acervo <span class="badge"><?php echo $numRow ?></span>
					 	</a>
					 </td>
					 <td class='col-acoes col-md-2'>

					 	<a id='bt-create-exemplar' class='btn btn-success btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Novo Exemplar"  data-target='#modal-exemplar' role='button'>
					 		<span class='glyphicon glyphicon-plus' aria-hidden='true'></span> 
					 	</a>
					 	<a id='bt-update' class='btn btn-primary btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Editar Título" data-target='#modal-titulo' role='button'>
					 		<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> 
					 	</a>
					 	<a id='bt-delete-titulo' class='btn btn-danger btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Deletar Título" data-target='#modal-del' role='button'>
					 		<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> 
					 	</a>
					 </td>
				</tr>
			<?php
			}
    	}

    	function tituloTabelaExemplares(){
    		global $conexao;
    		$titulo_id = $_GET['titulo_id'];
    		$select = "SELECT * FROM titulo WHERE id='$titulo_id'";
    		$result = mysqli_query($conexao, $select);

    		while($row = mysqli_fetch_assoc($result)){
    			$titulo = utf8_encode($row['titulo']);
    			$autor = utf8_encode($row['autor']);
    			$descricao = utf8_encode($row['descricao']);
    			$tipo_exemplar = utf8_encode($row['tipo_exemplar']);
    		?>
				<blockquote>
					<p>
						<?php echo $titulo ?>, <?php echo $autor ?> -
						<?php echo $tipo_exemplar ?>
					</p>
					<div class="descricao-acervo-estilo">
						<?php echo $descricao ?>
					</div>
			    </blockquote>

    		<?php
    		}
    	}

    	function mostraSelect($tipo){
    		global $conexao;

    		$select = "SELECT * FROM $tipo ORDER BY nome";
    		$result = mysqli_query($conexao, $select);

    		while($row = mysqli_fetch_assoc($result)){
    			$id = utf8_encode($row['id']);
    			$nome = utf8_encode($row['nome']);

    			if($tipo=='tipo_emprestimo'){
    				$dias = utf8_encode($row['dias']);
    			}
    			else if($tipo=='multa'){
    				$valor = utf8_encode($row['valor']);
    			}
    		?>
				
				<option value="<?php echo $id; ?>" <?php if($tipo=='tipo_emprestimo'){ echo 'data-dia="'.$dias.'"';}?>>
					<?php echo $nome;
					if($tipo=='tipo_emprestimo'){
						echo ' ('.$dias.' dias)';
					}
					else if($tipo=='multa'){
						echo ' (R$ '.$valor.')';
					}
					?>
				 </option>

    		<?php
    		}
    	}

		function tabelaExemplares(){

    		global $conexao;
    		$titulo_id = $_GET['titulo_id'];
			// Select * traz todos os usuários cadastrados na tabela
			// Order By ordena por ASC - nome ascendente
			$select = "SELECT * FROM exemplar WHERE titulo_id='$titulo_id' ORDER BY id ASC";               
			$result = mysqli_query($conexao, $select);
			//se vazio
			$numRow = mysqli_num_rows($result);
			if($numRow==0){
			?>
			
				<tr class='row-tabela row'>
					<td class='col-vazio col-md-12' colspan="5">
						<p class="text-center">Ainda não há exemplares</p>
					</td> 
				</tr>
			<?php
			}

			//resultado do select
			//Enquanto existir usuários no banco ele insere uma nova linha e exibe os dados
			while ($row = mysqli_fetch_assoc($result)) {                     
				$id = $row['id'];                     
				$status = utf8_encode($row['status']);
				$chamada = utf8_encode($row['chamada']);
				$isbn = utf8_encode($row['isbn']);
				$edicao = utf8_encode($row['edicao']);
				$volume = utf8_encode($row['volume']);
				$editora = utf8_encode($row['editora']);
				$cidade = utf8_encode($row['cidade']);
				$ano = utf8_encode($row['ano']);
				$descricao_fisica = utf8_encode($row['descricao_fisica']);
			?> 
				<tr class='row-tabela row'>
					 <!-- Hiddens -->
					 <input type='hidden' class="hide-id" value='<?php echo $id ?>'/>
					 <input type='hidden' class="hide-status" value='<?php echo $status ?>'/>
					 <input type='hidden' class="hide-chamada" value='<?php echo $chamada ?>'/>
					 <input type='hidden' class="hide-isbn" value='<?php echo $isbn ?>'/>
					 <input type='hidden' class="hide-edicao" value='<?php echo $edicao ?>'/>
					 <input type='hidden' class="hide-volume" value='<?php echo $volume ?>'/>
					 <input type='hidden' class="hide-editora" value='<?php echo $editora ?>'/>
					 <input type='hidden' class="hide-cidade" value='<?php echo $cidade ?>'/>
					 <input type='hidden' class="hide-ano" value='<?php echo $ano ?>'/>
					 <input type='hidden' class="hide-descricao-fisica" value='<?php echo $descricao_fisica ?>'/>
					<!-- inicio -->
					 <td class='col-status col-md-1 col-xs-2'>
					 	<?php
					 	if($status==1){
					 	?>
							<a id='bt-create-reserva' class='btn btn-success btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Reservar Exemplar"  data-target='#modal-reserva' role='button'>
								<span class='glyphicon glyphicon-share' aria-hidden='true'></span> 
							</a>					
						<?php
					 		}else{
					 	?>
							<a id='bt-reservado' class='btn btn-danger btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Exemplar reservado" role='button'>
								<span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span> 
							</a>
						<?php
					 		}
					 	?>
					 </td>               
					 <td class='col-chamada col-md-2 col-xs-3'><?php echo $chamada ?></td>               
					 <td class='col-publicacao col-md-4 hidden-sm hidden-xs'>
					 	<?php echo $editora ?>, <?php echo $cidade ?> - <?php echo $ano ?>
					 </td>               
					 <td class='col-publicacao col-md-2 col-xs-3'>
					 	<?php echo $edicao ?>ª Ed. / Vol. <?php echo $volume ?>
					 </td>

					 <td class='col-acoes col-md-3 col-xs-4'>
					 	<!-- Botões grandes -->
					 	<a id='bt-update-exemplar' class='btn btn-primary btn-sm <?php if($status==0):echo 'disabled'; endif?>' data-toggle='modal' rel='modal' data-tooltip='true' title="Editar Exemplar" data-target='#modal-exemplar' role='button'>
					 		<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> 
					 	</a>
					 	<a id='bt-delete-exemplar' class='btn btn-danger btn-sm <?php if($status==0):echo 'disabled'; endif?>' data-toggle='modal' rel='modal' data-tooltip='true' title="Deletar Exemplar" data-target='#modal-del' role='button'>
					 		<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> 
					 	</a>
					 	</a>
					 </td>
				</tr>
			<?php
			}
		}

    	// Mostra a tabela de títulos cadastrados
    	function tabelaLeitores(){
    		global $conexao, $limite, $offset;
			// Select * traz todos os usuários cadastrados na tabela
			// Order By ordena por ASC - nome ascendente
			// Limit limita o nº de linhas retornadas e Offset é o início da contagem
			$select = "SELECT * FROM leitor ORDER BY nome ASC LIMIT $limite OFFSET $offset";                 
			$result = mysqli_query($conexao, $select);

			

			//resultado do select
			//Enquanto existir usuários no banco ele insere uma nova linha e exibe os dados
			while ($row = mysqli_fetch_assoc($result)) {                     
				$id = $row['id'];                     
				$nome = utf8_encode($row['nome']);
				$email = utf8_encode($row['email']);
				$cpf = utf8_encode($row['cpf']);
				$rg = utf8_encode($row['rg']);
				$nascimento = implode("/",array_reverse(explode("-",$row['nascimento'])));
				$sexo = $row['sexo'];
				$cidade = utf8_encode($row['cidade']);
				$cep = $row['cep'];
				$bairro = utf8_encode($row['bairro']);
				$rua = utf8_encode($row['rua']);
				$num = $row['num'];
				$comp = utf8_encode($row['comp']);
			?> 
				<tr class='row-tabela row'>
					 <!-- Hiddens -->
					 <input type='hidden' class="hide-id" value='<?php echo $id ?>'/>
					 <input type='hidden' class="hide-nome" value='<?php echo $nome ?>'/>
					 <input type='hidden' class="hide-email" value='<?php echo $email ?>'/>
					 <input type='hidden' class="hide-cpf" value='<?php echo $cpf ?>'/>
					 <input type='hidden' class="hide-rg" value='<?php echo $rg ?>'/>
					 <input type='hidden' class="hide-nascimento" value='<?php echo $nascimento ?>'/>
					 <input type='hidden' class="hide-sexo" value='<?php echo $sexo ?>'/>
					 <input type='hidden' class="hide-cidade" value='<?php echo $cidade ?>'/>
					 <input type='hidden' class="hide-cep" value='<?php echo $cep ?>'/>
					 <input type='hidden' class="hide-bairro" value='<?php echo $bairro ?>'/>
					 <input type='hidden' class="hide-rua" value='<?php echo $rua ?>'/>
					 <input type='hidden' class="hide-num" value='<?php echo $num ?>'/>
					 <input type='hidden' class="hide-comp" value='<?php echo $comp ?>'/>
					<!-- inicio -->
					 <td class='col-nome col-md-4'><?php echo $nome ?></td>               
					 <td class='col-email col-md-3 hidden-sm hidden-xs'><?php echo $email ?></td>
					 <td class='col-cpf col-md-2'><?php echo $cpf ?></td>

					 <td class='col-acoes col-md-3'>
					 	<!-- <a id='bt-create-exemplar' class='btn btn-success btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Novo Exemplar"  data-target='#modal-exemplar' role='button'>
					 		<span class='glyphicon glyphicon-plus' aria-hidden='true'></span> 
					 	</a> -->
					 	<a id='bt-update-leitor' class='btn btn-primary btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Editar Leitor" data-target='#modal-leitor' role='button'>
					 		<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> 
					 	</a>
					 	<a id='bt-delete-leitor' class='btn btn-danger btn-sm' data-toggle='modal' rel='modal' data-tooltip='true' title="Deletar Leitor" data-target='#modal-del' role='button'>
					 		<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> 
					 	</a>
					 </td>
				</tr>
			<?php
			}
    	}
?>