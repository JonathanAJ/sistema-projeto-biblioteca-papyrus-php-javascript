<?php
	include "../crud/mostrar.php";

	$tipo = $_POST['tipo'];

	function mostraAvisoJS(){
	?>
		<script>
			//função para mostrar um aviso
			var contNotf = 0;
	     	function aviso(texto, tipo){
	     		contNotf++;
	     		$('#notificacao').prepend('<div class="alert alert-'+ tipo
	     				+' alert-dismissible d-none alert-'+contNotf+'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">'
	     				+'<span aria-hidden="true">&times;</span></button><span id="text-notificacao">'+
	     				texto +'</span></div>');
	     		$('#notificacao .alert-'+contNotf).fadeIn('slow').delay(3000).fadeOut('slow', function(){
	     			$(this).remove();
	     		});
	     		$('#notificacao .alert').css('margin-bottom','5px');
	     	}

	     	//função para atualizar a tabela principal
     		function atualizaTabela(textoAviso){
		        var url = window.location.href;
		        $('#table').load(url+' #conteudo', aviso(textoAviso, 'success'));
     		}
		</script>
	<?php
	}

	if($tipo=='multa'){
	?>
		<div class="row">
			<div class="col-md-12">
				<a id='bt-create-multa' class="btn btn-success center-block" data-toggle="modal" rel="modal" data-target="#modal-admin2" role="button">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Valor de Multa
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
					<!--        Tabela de exibição dos dados-->
					<div id="table">
						<div id="conteudo" class="table-altura">
							<table class="table table-striped" >
							  <thead>
							    <tr class="row">
							      <th><h4>Nome</h4></th>
							      <th class='hidden-sm hidden-xs'><h4>Valor</h4></th>
							      <th><h4>Ações</h4></th>
							    </tr>
							  </thead>
							  <tbody>
							    <?php
							  		tabelaMulta();
							  	?>
							  </tbody>
							</table>
						</div>
				    </div>
			</div>
		</div>
	<?php
	}else if($tipo=='multa-form'){
	?>
		<form id="cadMulta" action="" method="post">
			<div class="row">
				<div class="col-md-12">
					<!-- ID -->
					<input class="hide-id-form" type="hidden" name="id" class="form-control">
					<!--  -->
					<label for="multa-nome">Nome:</label>
					<input id="multa-nome" type="text" name="nome" class="form-control" placeholder="Insira um nome" required>
					<br>
			    </div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="multa-valor">Valor:</label> (R$)
					<input id="multa-valor" type="number" value="1.00" min="0.00" max="9.99" step="0.01" name="valor" class="form-control" required>
					<br>
				</div>
				<div class="col-md-6">
					<label for="button-model">Ação:</label>
					<br>
		     		<button id="button-model" type="submit" class="btn btn-success">
						<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
						<span id="bt-value"></span>
					</button>
				</div>
			</div>
		</form>

		<!-- Chamada do meu script -->
		<script>

			/*
			Cadastro de Multa
			------------------------------------------------------
			*/

     		$('#cadMulta').submit(function(e) {
     			e.preventDefault();
     			var acao = $('.admin-body #button-model #bt-value').text();
     			var tipo = 'multa';
     			if(acao=='Criar'){
					//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadMulta').serialize();            
	     			$.ajax({                 
	     				type: 'POST',
	     				url: 'crud/salvar.php',
		                data: ("tipo="+tipo+"&")+dados,
		                success: function(response) {
		                	// Se tudo der certo atualize a modal anterior
     						var tipo = 'multa';
		                	$.ajax({
		     					type: 'POST',
		     					url: 'controller/modal.php',
		     					data: 'tipo='+tipo,
		     					success: function(retorno){
		     						$('#modal-admin .admin-body').html(retorno);
		     					},
				                error: function(XMLHttpRequest, textStatus, errorThrown) {
				                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
				                }
		     				});
		                	// feche tudo e mande a mensagem de aviso
     						$('#modal-admin2').modal('hide');
		                	var textoAviso = "A multa <em>"+$('#modal-admin2 input[name="nome"]').val()+"</em> foi cadastrada com sucesso!"
		                    // mostra aviso
		                    aviso(textoAviso, 'success');
		                    console.log("msg= "+ response);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}else if(acao=='Atualizar'){
     				//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadMulta').serialize();             
	     			$.ajax({                 
	     				type: 'POST',                
	     				url: 'crud/editar.php',
		                data: ("tipo="+tipo+"&")+dados,//nome=313131&senha=123123 
		                success: function(response) {
		                	// Se tudo der certo atualize a modal anterior
     						var tipo = 'multa';
		                	$.ajax({
		     					type: 'POST',
		     					url: 'controller/modal.php',
		     					data: 'tipo='+tipo,
		     					success: function(retorno){
		     						$('#modal-admin .admin-body').html(retorno);
		     					},
				                error: function(XMLHttpRequest, textStatus, errorThrown) {
				                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
				                }
		     				});
		                	// feche tudo e mande a mensagem de aviso
     						$('#modal-admin2').modal('hide');
		                	var textoAviso = "A multa <em>"+$('#modal-admin2 input[name="nome"]').val()+"</em> foi atualizada com sucesso!"
		                    // mostra aviso
		                    aviso(textoAviso, 'success');
		                    console.log("msg= "+ response);
		                    console.log(("tipo="+tipo+"&")+dados);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}
     		});
		</script>
	<?php
		mostraAvisoJS();
	
	}else if($tipo=='multa-form-delete'){
	?>
		<p>Você tem certeza disso?</p>
		<p class="text-danger">As reservas cadastradas<br> também serão excluídas.</p>
		<form id="delMulta" action="" method="post">
			<!-- ID -->
			<input class="hide-id-form" type="hidden" name="id" class="form-control">
			<!--  -->
			<button id="button-model-deletar" type="submit" class="btn btn-success pull-right">
		    	<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
			 	<span id="bt-value"></span>
			</button>
		</form>
		<div class="clearfix"></div>
		<!-- Chamada do meu script -->
		<script>

			/*
			Deletar Multa
			------------------------------------------------------
			*/
			$('#delMulta').submit(function(e){
     			e.preventDefault();
     			var tipo = 'delete-multa'; 
     			var dados = $('#delMulta').serialize();        
	     			$.ajax({
	     				type: 'POST',                
	     				url: 'crud/deletar.php',
		                data: "tipo="+tipo+"&"+dados,
		                success: function(response) {
		                	// Se tudo der certo atualize a modal anterior
     						var tipo = 'multa';
		                	$.ajax({
		     					type: 'POST',
		     					url: 'controller/modal.php',
		     					data: 'tipo='+tipo,
		     					success: function(retorno){
		     						$('#modal-admin .admin-body').html(retorno);
		     					},
				                error: function(XMLHttpRequest, textStatus, errorThrown) {
				                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
				                }
		     				});
		                	// feche tudo e mande a mensagem de aviso
     						$('#modal-admin2').modal('hide');
		                	var textoAviso = "A multa selecionada foi excluída com sucesso!"
		                    // mostra aviso
		                    aviso(textoAviso, 'success');
		                    console.log("msg= "+ response);
		                    console.log("tipo="+tipo+"&"+dados);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
			});
		</script>
	<?php
		mostraAvisoJS();

	}else if($tipo=='tempo'){
	?>
		<div class="row">
			<div class="col-md-12">
				<a id='bt-create-tempo' class="btn btn-success center-block" data-toggle="modal" rel="modal" data-target="#modal-admin2" role="button">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Tipo de Empréstimo
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
					<!--        Tabela de exibição dos dados-->
					<div id="table">
						<div id="conteudo" class="table-altura">
							<table class="table table-striped" >
							  <thead>
							    <tr class="row">
							      <th><h4>Nome</h4></th>
							      <th class='hidden-sm hidden-xs'><h4>Dias</h4></th>
							      <th><h4>Ações</h4></th>
							    </tr>
							  </thead>
							  <tbody>
							    <?php
							  		tabelaTempo();
							  	?>
							  </tbody>
							</table>
						</div>
				    </div>
			</div>
		</div>
	<?php
	}else if($tipo=='tempo-form'){
	?>
		<form id="cadTempo" action="" method="post">
			<div class="row">
				<div class="col-md-12">
					<!-- ID -->
					<input class="hide-id-form" type="hidden" name="id" class="form-control">
					<!--  -->
					<label for="tempo-nome">Nome:</label>
					<input id="tempo-nome" type="text" name="nome" class="form-control" placeholder="Insira um nome" required>
					<br>
			    </div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="tempo-dias">Dias:</label>
					<input id="tempo-dias" type="number" value="5" min="5" max="100" step="1" name="dias" class="form-control" required>
					<br>
				</div>
				<div class="col-md-6">
					<label for="button-model">Ação:</label>
					<br>
		     		<button id="button-model" type="submit" class="btn btn-success">
						<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
						<span id="bt-value"></span>
					</button>
				</div>
			</div>
		</form>

		<!-- Chamada do meu script -->
		<script>

			/*
			Cadastro de Multa
			------------------------------------------------------
			*/

     		$('#cadTempo').submit(function(e) {
     			e.preventDefault();
     			var acao = $('.admin-body #button-model #bt-value').text();
     			var tipo = 'tempo';
     			if(acao=='Criar'){
					//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadTempo').serialize();            
	     			$.ajax({                 
	     				type: 'POST',
	     				url: 'crud/salvar.php',
		                data: ("tipo="+tipo+"&")+dados,
		                success: function(response) {
		                	// Se tudo der certo atualize a modal anterior
     						var tipo = 'tempo';
		                	$.ajax({
		     					type: 'POST',
		     					url: 'controller/modal.php',
		     					data: 'tipo='+tipo,
		     					success: function(retorno){
		     						$('#modal-admin .admin-body').html(retorno);
		     					},
				                error: function(XMLHttpRequest, textStatus, errorThrown) {
				                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
				                }
		     				});
		                	// feche tudo e mande a mensagem de aviso
     						$('#modal-admin2').modal('hide');
		                	var textoAviso = "O Tempo <em>"+$('#modal-admin2 input[name="nome"]').val()+"</em> foi cadastrado com sucesso!"
		                    // mostra aviso
		                    aviso(textoAviso, 'success');
		                    console.log("msg= "+ response);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}else if(acao=='Atualizar'){
     				//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadTempo').serialize();             
	     			$.ajax({                 
	     				type: 'POST',                
	     				url: 'crud/editar.php',
		                data: ("tipo="+tipo+"&")+dados,//nome=313131&senha=123123 
		                success: function(response) {
		                	// Se tudo der certo atualize a modal anterior
     						var tipo = 'tempo';
		                	$.ajax({
		     					type: 'POST',
		     					url: 'controller/modal.php',
		     					data: 'tipo='+tipo,
		     					success: function(retorno){
		     						$('#modal-admin .admin-body').html(retorno);
		     					},
				                error: function(XMLHttpRequest, textStatus, errorThrown) {
				                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
				                }
		     				});
		                	// feche tudo e mande a mensagem de aviso
     						$('#modal-admin2').modal('hide');
		                	var textoAviso = "O Tempo <em>"+$('#modal-admin2 input[name="nome"]').val()+"</em> foi atualizado com sucesso!"
		                    // mostra aviso
		                    aviso(textoAviso, 'success');
		                    console.log("msg= "+ response);
		                    console.log(("tipo="+tipo+"&")+dados);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}
     		});
		</script>
	<?php
		mostraAvisoJS();

	}else if($tipo=='tempo-form-delete'){
	?>
		<p>Você tem certeza disso?</p>
		<p class="text-danger">As reservas cadastradas<br> também serão excluídas.</p>
		<form id="delTempo" action="" method="post">
			<!-- ID -->
			<input class="hide-id-form" type="hidden" name="id" class="form-control">
			<!--  -->
			<button id="button-model-deletar" type="submit" class="btn btn-success pull-right">
		    	<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
			 	<span id="bt-value"></span>
			</button>
		</form>
		<div class="clearfix"></div>
		<!-- Chamada do meu script -->
		<script>

			/*
			Deletar Multa
			------------------------------------------------------
			*/
			$('#delTempo').submit(function(e){
     			e.preventDefault();
     			var tipo = 'delete-tempo'; 
     			var dados = $('#delTempo').serialize();        
	     			$.ajax({
	     				type: 'POST',                
	     				url: 'crud/deletar.php',
		                data: "tipo="+tipo+"&"+dados,
		                success: function(response) {
		                	// Se tudo der certo atualize a modal anterior
     						var tipo = 'tempo';
		                	$.ajax({
		     					type: 'POST',
		     					url: 'controller/modal.php',
		     					data: 'tipo='+tipo,
		     					success: function(retorno){
		     						$('#modal-admin .admin-body').html(retorno);
		     					},
				                error: function(XMLHttpRequest, textStatus, errorThrown) {
				                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
				                }
		     				});
		                	// feche tudo e mande a mensagem de aviso
     						$('#modal-admin2').modal('hide');
		                	var textoAviso = "O Tempo selecionado foi excluído com sucesso!"
		                    // mostra aviso
		                    aviso(textoAviso, 'success');
		                    console.log("msg= "+ response);
		                    console.log("tipo="+tipo+"&"+dados);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
			});
		</script>
	<?php
		mostraAvisoJS();

	}else if($tipo=='reserva-form'){
	?>

		<!-- inicio form -->
		<form id="cadReserva" action="" method="post">
			<div class="row">
				<div class="col-md-2">
					<!-- ID -->
					<input class="hide-id-form" type="hidden" name="exemplar_id" class="form-control">
					<!--  -->
					<label for="chamada-reserva-form">Chamada:</label>
					<input id="chamada-reserva-form" disabled="disabled" type="text" name="chamada" class="form-control" value="">
					<br>
				</div>
				<div class="col-md-6">
					<label for="leitor-form">Leitor:</label>
					<select  id="leitor-form" class="form-control selectpicker" name="leitor_id" data-live-search="true" data-size="auto">
						<option value="">Selecione</option>
						<?php
							mostraSelect('leitor');
						?>
					</select>
					<br>
				</div>
				<div class="col-md-4">
					<label for="emprestimo-form">Empréstimo:</label>
					<input id="emprestimo-form" type="text" name="data_emprestimo" class="form-control" value="<?php echo $hoje = date("d/m/Y");  ?>">
					<br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label for="tempo-emprestimo-form">Tempo de Empréstimo:</label>
					<select  id="tempo-emprestimo-form" class="form-control" name="tipo_emprestimo_id" required>
						<option value="">Selecione</option>
						<?php
							mostraSelect('tipo_emprestimo');
						?>
					</select>
					<br>
				</div>
				<div class="col-md-4">
					<label for="multa-form">Tipo de Multa:</label>
					<select  id="multa-form" class="form-control" name="multa_id">
						<?php
							mostraSelect('multa');
						?>
					</select>
					<br>
				</div>
				<div class="col-md-4">
					<label for="entrega-form">Data de Entrega:</label>
					<input id="entrega-form" type="text" name="data_entrega" class="form-control">
					<br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button id="button-model" type="submit" class="btn btn-success pull-right">
						<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
						<span id="bt-value"></span>
					</button>
				</div>
			</div>
			<div class="clearfix"></div>
		</form>
		<!-- Chamada do meu script -->
		<script>

			$(document).ready(function(){
				// Colocar selectpicker no determinado form
				$('.selectpicker').selectpicker();

				//quando mudar o tempo de empréstimo recalcula
				$("#tempo-emprestimo-form").change(function() {
					var dias = $('#tempo-emprestimo-form option:selected').attr('data-dia');
				
					$.ajax({
						url: 'controller/tempo.php',
						type: 'POST',
						data: 'dias='+dias,
						success: function(resposta){

							$('#entrega-form').val(resposta)

						}
					});
				});

			});

			/*
			Cadastro de Multa
			------------------------------------------------------
			*/

     		$('#cadReserva').submit(function(e) {
     			e.preventDefault();
     			var acao = $('#button-model #bt-value').text();
     			var tipo = 'reserva';
     			//pega os dados do formulario para serem enviados             
     			var dados = $('#cadReserva').serialize();
     			var leitor = $('#leitor-form').val();
     			
     			console.log(("tipo="+tipo+"&")+dados);
     			if(leitor==''){
     				var textoAviso = "Você esqueceu de adicionar um leitor válido!"
		            // mostra aviso
		            aviso(textoAviso, 'warning');

     			}else{
	     			if(acao=='Criar'){           
		     			$.ajax({                 
		     				type: 'POST',
		     				url: 'crud/salvar.php',
			                data: ("tipo="+tipo+"&")+dados,
			                success: function(response) {
			                	// Se tudo der certo atualize a modal anterior
	     						var tipo = 'reserva';
			                	$.ajax({
			     					type: 'POST',
			     					url: 'controller/modal.php',
			     					data: 'tipo='+tipo,
			     					success: function(retorno){
			     						$('#modal-admin .admin-body').html(retorno);
			     					},
					                error: function(XMLHttpRequest, textStatus, errorThrown) {
					                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
					                }
			     				});
			                	// feche tudo e mande a mensagem de aviso
	     						$('#modal-reserva').modal('hide');
			                	var textoAviso = "Reserva cadastrada com sucesso!"
			                    // atualiza a tabela
		                    	atualizaTabela(textoAviso);
			                    console.log("msg= "+ response);
			                },
			                error: function(XMLHttpRequest, textStatus, errorThrown) {
			                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
			                }
						  });

	     			}else if(acao=='Atualizar'){            
		     			$.ajax({                 
		     				type: 'POST',                
		     				url: 'crud/editar.php',
			                data: ("tipo="+tipo+"&")+dados,//nome=313131&senha=123123 
			                success: function(response) {
			                	// Se tudo der certo atualize a modal anterior
	     						var tipo = 'reserva';
			                	$.ajax({
			     					type: 'POST',
			     					url: 'controller/modal.php',
			     					data: 'tipo='+tipo,
			     					success: function(retorno){
			     						$('#modal-admin .admin-body').html(retorno);
			     					},
					                error: function(XMLHttpRequest, textStatus, errorThrown) {
					                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
					                }
			     				});
			                	// feche tudo e mande a mensagem de aviso
	     						$('#modal-admin2').modal('hide');
			                	var textoAviso = "O Tempo <em>"+$('#modal-admin2 input[name="nome"]').val()+"</em> foi atualizado com sucesso!"
			                    // mostra aviso
			                    aviso(textoAviso, 'success');
			                    console.log("msg= "+ response);
			                    console.log(("tipo="+tipo+"&")+dados);
			                },
			                error: function(XMLHttpRequest, textStatus, errorThrown) {
			                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
			                }
						  });
	     			}

     			}
     		});
		</script>
	<?php
		mostraAvisoJS();
	}