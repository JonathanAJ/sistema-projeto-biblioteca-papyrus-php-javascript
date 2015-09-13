<?php 
	include "header.php";
	include 'crud/mostrar.php';
?>
	<main id="principal" class="row" role="main">
		<ol class="breadcrumb">
		  <li><a href="./index.php">Home</a></li>
		  <li class="active">Acervo</li>
		</ol>	
		<div class="row">
			<div class="col-md-12">
		      	<div class="row">
		      		<div class="col-md-12">
		      		<?php
						tituloTabelaExemplares();
		      		?>
			      	</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-12">
			      		<!--        Tabela de exibição dos dados-->
						<div id="table">
							<div id="conteudo">
								<table class="table table-striped">
								  <thead>
								    <tr class="row">
								      <th><h4>Status</h4></th>
								      <th><h4>Chamada</h4></th>
								      <th class='hidden-sm hidden-xs'><h4>Publicação</h4></th>
								      <th><h4>Ed./Vol.</h4></th>
								      <th><h4>Ações</h4></th>
								    </tr>
								  </thead>
								  <tbody>
								    <?php
								  		tabelaExemplares();
								  	?>
								  </tbody>
								</table>
			      			</div>
						</div>
		      		</div>
				</div>
			</div>
		</div>

		<!-- Modal Criar/Atualizar Exemplar-->
		<div id="modal-exemplar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-exemplar-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modal-exemplar-head"></h4>
		      </div>
		      <div class="modal-body">
		  		<div id="modal-alert" class="alert hidden" role="alert"></div>
				    <form id="cadExemplar" action="" method="post">
				    		<div class="row">
				    			<div class="col-md-5">
									<label for="chamada-exemplar-form">Nº da Chamada:</label>
									<input id="chamada-exemplar-form" type="text" name="chamada" class="form-control" placeholder="Insira Nº da Chamada" required>
									<br>
				    			</div>
								<div class="col-md-2">
									<label for="volume-exemplar-form">Volume:</label>
									<input id="volume-exemplar-form" type="number" value="1" name="volume" class="form-control" required>
									<br>
								</div>
								<div class="col-md-2">
									<label for="edicao-exemplar-form">Edição:</label>
									<input id="edicao-exemplar-form" type="number" value="1" min="1" name="edicao" class="form-control" required>
									<br>
								</div>
								<div class="col-md-3">
									<label for="ano-exemplar-form">Ano:</label>
									<input id="ano-exemplar-form" type="number" value="0000" max="2100" name="ano" class="form-control" required>
									<br>
								</div>
				    		</div>
				    		<div class="row">
								<div class="col-md-5">
									<label for="isbn-exemplar-form">ISBN:</label>
									<input id="isbn-exemplar-form" type="text" name="isbn" class="form-control" placeholder="Insira o ISBN"  required>
									<br>
								</div>
								<div class="col-md-4">
									<label for="editora-exemplar-form">Editora:</label>
									<input id="editora-exemplar-form" type="text" name="editora" class="form-control" placeholder="Insira a Editora" required>
									<br>
								</div>
								<div class="col-md-3">
									<label for="cidade-exemplar-form">Cidade:</label>
									<input id="cidade-exemplar-form" type="text" name="cidade" class="form-control" placeholder="Insira a Cidade" required>
									<br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label for="descricao-exemplar-form">Descrição Física:</label>
									<textarea name="descricao_fisica" id="descricao-form" class="form-control" placeholder="Insira uma descrição do estado do livro" rows="3"></textarea>
									<br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
							        <button id="button-exemplar" type="submit" class="btn btn-success pull-right">
									 	<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
									 	<span id="bt-value"></span>
							        </button>
								</div>
							</div>
					        <div class="clearfix"></div>	
					</form>
			   </div>
		    </div>
		  </div>
		</div>

		<!-- Modal Deletar -->
		<div id="modal-del" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="modal-del-label">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modal-del-head">Deletar Exemplar:</h4>
		      </div>
		      <div class="modal-body">
					<p>Você tem certeza disso?</p>
					<form id="delExemplar" action="" method="post">
		     			<button id="button-model-deletar" type="submit" class="btn btn-success pull-right">
						 	<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
						 	<span id="bt-value"></span>
					 	</button>
			        </form>
			        <div class="clearfix"></div>
			   </div>
		    </div>
		  </div>
		</div>

		<!-- Modal Criar Reserva-->
		<div id="modal-reserva" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-reserva-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modal-reserva-head"></h4>
		      </div>
		      <div class="modal-body reserva-body">
			 
			  </div>
		    </div>
		  </div>
		</div>

		<!-- Notificação -->
		<div id="notificacao">
		</div>
	</main>

<?php
	include "footer.php";
?>