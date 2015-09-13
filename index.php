<?php 
	include "header.php";
	include 'crud/mostrar.php';
?>
	<main id="principal" class="row" role="main">
		<ol class="breadcrumb">
		  <li class="active">Home</li>
		</ol>
		<div class="row">
			<div class="col-lg-12 col-md-12">
					<div class="row">
						<div class="col-md-9">
							<a id='bt-create' class="btn btn-success" data-toggle="modal" rel="modal" data-target="#modal-titulo" role="button">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Título
							</a>
						</div>
						<div class="col-md-3">
							<form id="pesquisaTitulo" action="" method="post">
								<div class="row">
									<div class="col-md-10">
										<input id="pesquisa-titulo" type="text" name="pesquisa" value="<?php echo $_GET['pesquisa'];?>" class="form-control" placeholder="Pesquise o Título desejado">
									</div>
									<div class="col-md-2">
										<button id="pesquisar" type="submit" class="btn btn-default pull-right">
										 	<span class='glyphicon glyphicon-search' aria-hidden='true'></span>
										 	<span id="bt-value"></span>
									 	</button>
									</div>
								</div>
					        </form>
						</div>
					</div>
					<!--        Tabela de exibição dos dados-->
					<div id="table">
						<div id="conteudo">
							<table class="table table-striped">
							  <thead>
							    <tr class="row">
							      <th><h4>Título</h4></th>
							      <th class='hidden-sm hidden-xs'><h4>Autor</h4></th>
							      <th><h4>Exemplares</h4></th>
							      <th><h4>Ações</h4></th>
							    </tr>
							  </thead>
							  <tbody>
							    <?php
							  		tabelaTitulos();
							  	?>
							  </tbody>
							</table>
							<nav class="pull-left" id="paginacao">
								<ul class="pagination pagination-sm">
								  <?php
								  	mostraPag('titulo', $pagina);
								  ?>
								</ul>
							</nav>
							<p class="pull-right" style="padding: 5px 0; color: #337ab7;"><?php echo mostraTotal('titulo') ?> títulos cadastrados</p>
						</div>
				    </div>
			</div>
		</div>

		<!-- Modal Criar/Atualizar Título-->
		<div id="modal-titulo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modal-titulo-head"></h4>
		      </div>
		      <div class="modal-body">
		  		<div id="modal-alert" class="alert hidden" role="alert"></div>
			    <form id="cadTitulo" action="" method="post">
			    		<div class="row">
			    			<div class="col-md-12">
								<label for="titulo-form">Título:</label>
								<input id="titulo-form" type="text" name="titulo" class="form-control" placeholder="Insira o título" required>
								<br>
			    			</div>
			    		</div>
						<div class="row">
							<div class="col-md-8">
								<label for="autor-form">Autor:</label>
								<input id="autor-form" type="text" name="autor" class="form-control" placeholder="Insira o nome do autor" required>
							</div>
							<div class="col-md-4">
								<label for="tipo-form">Tipo:</label>
								<select class="form-control" name="tipo_exemplar" id="tipo-form">
								  <option value="Livro">Livro</option>
								  <option>Revista</option>
								  <option>Audiolivro</option>
								  <option>Monografia</option>
								  <option>Periódico</option>
								</select>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="descricao-form">Descrição:</label>
								<textarea name="descricao" id="descricao-form" class="form-control" placeholder="Insira uma breve descrição do título" rows="3"></textarea>
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
			    <div class="row">
			    	<div class="col-md-9">
						<label for="titulo-exemplar-form">Título:</label>
						<input id="titulo-exemplar-form" disabled="disabled" type="text" name="titulo" class="form-control" value="" required>
						<br>
			    	</div>
			    	<div class="col-md-3">
						<label for="tipo-exemplar-form">Tipo:</label>
						<select class="form-control" disabled="disabled" name="tipo_exemplar" id="tipo-exemplar-form">
						  <option value="Livro">Livro</option>
						  <option>Revista</option>
						  <option>Audiolivro</option>
						  <option>Monografia</option>
						  <option>Periódico</option>
						</select>
						<br>
			    	</div>
			    </div>
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
							<div class="col-md-3">
								<label for="isbn-exemplar-form">ISBN:</label>
								<input id="isbn-exemplar-form" type="text" name="isbn" class="form-control" placeholder="Insira o ISBN"  required>
								<br>
							</div>
							<div class="col-md-2">
								<label for="qntd-exemplar-form">Qntd:</label>
								<input id="qntd-exemplar-form" type="number" value="1" min="1" max="10" name="qntd" class="form-control" required>
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
		        <h4 class="modal-title" id="modal-del-head">Deletar Título:</h4>
		      </div>
		      <div class="modal-body">
					<p>Você tem certeza disso?</p>
					<p class="text-danger">Os exemplares cadastrados<br> também serão excluídos.</p>
					<form id="delTitulo" action="" method="post">
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

		<!-- Notificação -->
		<div id="notificacao">
		</div>
	</main>

<?php
	include "footer.php";
?>