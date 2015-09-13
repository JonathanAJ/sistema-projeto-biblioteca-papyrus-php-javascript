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
						<a id='bt-create-leitor' class="btn btn-success" data-toggle="modal" rel="modal" data-target="#modal-leitor" role="button">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Leitor
						</a>
					<!--        Tabela de exibição dos dados-->
					<div id="table">
						<div id="conteudo">
							<table class="table table-striped">
							  <thead>
							    <tr class="row">
							      <th><h4>Nome</h4></th>
							      <th class='hidden-sm hidden-xs'><h4>E-mail</h4></th>
							      <th><h4>CPF</h4></th>
							      <th><h4>Ações</h4></th>
							    </tr>
							  </thead>
							  <tbody>
							    <?php
							  		tabelaLeitores();
							  	?>
							  </tbody>
							</table>
							<nav class="pull-left" id="paginacao">
								<ul class="pagination pagination-sm">
								  <?php
								  	mostraPag('leitor', $pagina);
								  ?>
								</ul>
							</nav>
							<p class="pull-right" style="padding: 5px 0; color: #337ab7;"><?php echo mostraTotal('leitor') ?> leitores cadastrados</p>
						</div>
				    </div>
			</div>
		</div>

		<!-- Modal Criar/Atualizar Leitor-->
		<div id="modal-leitor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-exemplar-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="modal-exemplar-head"></h4>
		      </div>
		      <div class="modal-body">
		  		<div id="modal-alert" class="alert hidden" role="alert"></div>
			    <form id="cadLeitor" action="" method="post">
					    <div class="row">
					    	<div class="col-md-7">
								<label for="nome-form">Nome:</label>
								<input id="nome-form" type="text" name="nome" class="form-control" placeholder="Insira o nome do leitor" required>
								<br>
					    	</div>
					    	<div class="col-md-5">
								<label for="email-form">Email:</label>
								<input id="email-form" type="email" name="email" class="form-control" placeholder="Insira o e-mail" required>
								<br>
					    	</div>
					    </div>
			    		<div class="row">
			    			<div class="col-md-3">
								<label for="cpf-form">CPF:</label>
								<input id="cpf-form" type="text" name="cpf" class="form-control" placeholder="Insira o CPF" required>
								<br>
			    			</div>
							<div class="col-md-4">
								<label for="rg-form">RG:</label>
								<input id="rg-form" type="text" name="rg" class="form-control" placeholder="Insira o RG" required>
								<br>
							</div>
							<div class="col-md-2">
								<label for="sexo-form">Sexo:</label>
								<select class="form-control" name="sexo" id="sexo-form">
								  <option>M</option>
								  <option>F</option>
								</select>
								<br>
							</div>
							<div class="col-md-3">
								<label for="nascimento-form">Nascimento:</label>
								<input id="nascimento-form" name="nascimento" class="form-control" placeholder="dd/mm/aaaa" required>
								<br>
							</div>
			    		</div>
			    		<div class="row">
							<div class="col-md-3">
								<label for="cep-form">CEP:</label>
								<input id="cep-form" type="text" name="cep" class="form-control" placeholder="Insira o CEP" required>
								<br>
							</div>
							<div class="col-md-4">
								<label for="bairro-form">Bairro:</label>
								<input id="bairro-form" type="text" name="bairro" class="form-control" placeholder="Insira o bairro" required>
								<br>
							</div>
							<div class="col-md-5">
								<label for="rua-exemplar-form">Rua:</label>
								<input id="rua-form" type="text" name="rua" class="form-control" placeholder="Insira a rua" required>
								<br>
							</div>
							<div class="col-md-3">
								<label for="num-form">Nº:</label>
								<input id="num-form" type="text" name="num" class="form-control" placeholder="Insira o número" required>
								<br>
							</div>
							<div class="col-md-4">
								<label for="comp-form">Complemento:</label>
								<input id="comp-form" type="text" name="comp" class="form-control" placeholder="Insira um complemento"  required>
								<br>
							</div>
							<div class="col-md-5">
								<label for="cidade-form">Cidade:</label>
								<input id="cidade-form" type="text" name="cidade" class="form-control" placeholder="Insira a cidade"  required>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
						        <button id="button-leitor" type="submit" class="btn btn-success pull-right">
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
		        <h4 class="modal-title" id="modal-del-head">Deletar Leitor:</h4>
		      </div>
		      <div class="modal-body">
					<p>Você tem certeza disso?</p>
					<p class="text-danger">As reservas cadastradas<br> também serão excluídas.</p>
					<form id="delLeitor" action="" method="post">
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