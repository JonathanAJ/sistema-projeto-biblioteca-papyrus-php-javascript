$(document).ready(function() {

			/*
			Iniciar tooltip bootstrap
			------------------------------------------------------
			*/
			   
    		$('[data-tooltip="true"]').tooltip();

    		$('body').on('mouseenter','a', function() {
    			$('[data-tooltip="true"]').tooltip();
			});

			/*
			Pesquisa
			------------------------------------------------------
			*/

			$( "#pesquisaTitulo" ).submit(function(e) {
     			e.preventDefault();
				var txt = $('#pesquisa-titulo').val();
				location.href = './index.php?pesquisa='+txt;

			});

			/*
			Cadastro de títulos
			------------------------------------------------------
			*/
			          
     		$('#cadTitulo').submit(function(e) {
     			e.preventDefault();
     			var acao = $('#button-model #bt-value').text();
     			var tipo = 'titulo';
     			if(acao=='Criar'){
					//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadTitulo').serialize();             
	     			$.ajax({
	     				type: 'POST',                 
	     				url: 'crud/salvar.php',
		                data: ("tipo="+tipo+"&")+dados, 
		                success: function(response) {
		                	console.log(("tipo="+tipo+"&")+dados);
		                	console.log(response);
     						$('#modal-titulo').modal('hide');
		                	var textoAviso = "O Título <em>"+$('#cadTitulo input[name="titulo"]').val()+"</em> foi cadastrado com sucesso! Verifique na tabela abaixo."
		                    // atualiza a tabela
		                    atualizaTabela(textoAviso);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}else if(acao=='Atualizar'){
     				//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadTitulo').serialize();             
	     			$.ajax({                 
	     				type: 'POST',                
	     				url: 'crud/editar.php',
		                data: ("tipo="+tipo+"&"+"id="+id_selecionado+"&")+dados,//nome=313131&senha=123123 
		                success: function(response) {
     						$('#modal-titulo').modal('hide');
		                	var textoAviso = "O Título <em>"+$('#cadTitulo input[name="titulo"]').val()+"</em> foi atualizado com sucesso! Verifique na tabela abaixo."
		                   	// atualiza a tabela
		                    atualizaTabela(textoAviso);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}
     		});

			$('#delTitulo').submit(function(e){
     			e.preventDefault();
     			var tipo = 'delete-titulo';
	     			$.ajax({
	     				type: 'POST',                
	     				url: 'crud/deletar.php',
		                data: "tipo="+tipo+"&"+"id="+id_selecionado,
		                success: function(response, nome) {
     						$('#modal-del').modal('hide');
		                	var textoAviso = "O Título selecionado foi excluído com sucesso! Verifique na tabela abaixo."
		                    // atualiza a tabela
		                    atualizaTabela(textoAviso);
		                    console.log("msg= "+ response);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
			});

			/*
			Cadastro de exemplares
			------------------------------------------------------
			*/

     		$('#cadExemplar').submit(function(e) {
     			e.preventDefault();
     			var acao = $('#button-exemplar #bt-value').text();
     			var tipo = 'exemplar';
     			if(acao=='Criar'){
					//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadExemplar').serialize();             
	     			$.ajax({                 
	     				type: 'POST',
	     				url: 'crud/salvar.php',
		                data: ("tipo="+tipo+"&"+"titulo_id="+id_selecionado+"&")+dados, 
		                success: function(response) {
     						$('#modal-exemplar').modal('hide');
		                	var textoAviso = "O Exemplar em <em>"+$('#modal-exemplar input[name="titulo"]').val()+"</em> foi cadastrado com sucesso! Verifique na tabela abaixo."
		                    // atualiza a tabela
		                    atualizaTabela(textoAviso);
		                    console.log("msg= "+ response);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}else if(acao=='Atualizar'){
     				//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadExemplar').serialize();             
	     			$.ajax({                 
	     				type: 'POST',                
	     				url: 'crud/editar.php',
		                data: ("tipo="+tipo+"&"+"id="+id_selecionado+"&")+dados,//nome=313131&senha=123123 
		                success: function(response) {
     						$('#modal-exemplar').modal('hide');
		                	var textoAviso = "O Exemplar foi atualizado com sucesso! Verifique na tabela abaixo."
		                   	// atualiza a tabela
		                    atualizaTabela(textoAviso);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}
     		});

			$('#delExemplar').submit(function(e){
     			e.preventDefault();
     			var tipo = 'delete-exemplar';          
	     			$.ajax({
	     				type: 'POST',                
	     				url: 'crud/deletar.php',
		                data: "tipo="+tipo+"&"+"id="+id_selecionado,
		                success: function(response, nome) {
     						$('#modal-del').modal('hide');
		                	var textoAviso = "O Exemplar selecionado foi excluído com sucesso! Verifique na tabela abaixo."
		                    // atualiza a tabela
		                    atualizaTabela(textoAviso);
		                    console.log("msg= "+ response);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
			});

			/*
			Cadastro de leitores
			------------------------------------------------------
			*/

     		$('#cadLeitor').submit(function(e) {
     			e.preventDefault();
     			var acao = $('#button-leitor #bt-value').text();
     			var tipo = 'leitor';
     			if(acao=='Criar'){
					//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadLeitor').serialize();             
	     			$.ajax({                 
	     				type: 'POST',
	     				url: 'crud/salvar.php',
		                data: ("tipo="+tipo+"&")+dados,
		                success: function(response) {
     						$('#modal-leitor').modal('hide');
		                	var textoAviso = "O Leitor <em>"+$('#modal-leitor input[name="nome"]').val()+"</em> foi cadastrado com sucesso! Verifique na tabela abaixo."
		                    // atualiza a tabela
		                    atualizaTabela(textoAviso);
		                    console.log("msg= "+ response);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}else if(acao=='Atualizar'){
     				//pega os dados do formulario para serem enviados             
	     			var dados = $('#cadLeitor').serialize();             
	     			$.ajax({                 
	     				type: 'POST',                
	     				url: 'crud/editar.php',
		                data: ("tipo="+tipo+"&"+"id="+id_selecionado+"&")+dados,//nome=313131&senha=123123 
		                success: function(response) {
     						$('#modal-leitor').modal('hide');
		                	var textoAviso = "O Leitor <em>"+$('#modal-leitor input[name="nome"]').val()+"</em> foi atualizado com sucesso! Verifique na tabela abaixo."
		                    // atualiza a tabela
		                    atualizaTabela(textoAviso);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
     			}
     		});

			$('#delLeitor').submit(function(e){
     			e.preventDefault();
     			var tipo = 'delete-leitor';          
	     			$.ajax({
	     				type: 'POST',                
	     				url: 'crud/deletar.php',
		                data: "tipo="+tipo+"&"+"id="+id_selecionado,
		                success: function(response, nome) {
     						$('#modal-del').modal('hide');
		                	var textoAviso = "O Leitor selecionado foi excluído com sucesso! Verifique na tabela abaixo."
		                    // atualiza a tabela
		                    atualizaTabela(textoAviso);
		                    console.log("msg= "+ response);
		                },
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
					  });
			});

			/*
			Atributos do Modal aberto
			------------------------------------------------------
			*/
			$('#modal-admin2').on('hidden.bs.modal', function (e) {
				$('body').addClass('modal-open');
			});
			   
     		var id_selecionado;      
     		$("body").on("click", "a[rel=modal]", function(ev) {             
     			ev.preventDefault();
   				var modal = $('#modal .modal-body');

     			if(this.id=='bt-multa'){
     				$('.modal-title').text("Valor de Multa:");
     				var tipo = 'multa';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('.admin-body').html(retorno);
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-create-multa'){
     				$('#modal-admin2 .modal-title').text("Criar Novo Valor de Multa:");
     				var tipo = 'multa-form';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('#modal-admin2  .admin-body').html(retorno);
		     				$('#button-model').val("Criar");
		     				$('#button-model #bt-value').text("Criar");
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-update-multa'){
     				$('#modal-admin2 .modal-title').text("Atualizar Valor de Multa:");
     				var thisElement = this;
     				var tipo = 'multa-form';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('#modal-admin2 .modal-body').html(retorno);
		     				$('#button-model').val("Atualizar");
		     				$('#button-model #bt-value').text("Atualizar");
     						retornaCampos(thisElement);
     						$('.hide-id-form').val(retornaID(thisElement));
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-delete-multa'){
     				$('#modal-admin2 .modal-title').text("Deletar Valor de Multa:");
     				var thisElement = this;
     				var tipo = 'multa-form-delete';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('#modal-admin2 .modal-body').html(retorno);
		     				$('#button-model-deletar').val("Sim!");
		     				$('#button-model-deletar #bt-value').text("Sim!");
     						$('.hide-id-form').val(retornaID(thisElement));
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-tempo'){
     				$('.modal-title').text("Tempo de Empréstimo:");
     				var tipo = 'tempo';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('.admin-body').html(retorno);
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-create-tempo'){
     				$('#modal-admin2 .modal-title').text("Criar Tempo de Empréstimo:");
     				var tipo = 'tempo-form';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('#modal-admin2  .admin-body').html(retorno);
		     				$('#button-model').val("Criar");
		     				$('#button-model #bt-value').text("Criar");
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-update-tempo'){
     				$('#modal-admin2 .modal-title').text("Atualizar Valor de Tempo:");
     				var thisElement = this;
     				var tipo = 'tempo-form';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('#modal-admin2 .modal-body').html(retorno);
		     				$('#button-model').val("Atualizar");
		     				$('#button-model #bt-value').text("Atualizar");
     						retornaCampos(thisElement);
     						$('.hide-id-form').val(retornaID(thisElement));
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-delete-tempo'){
     				$('#modal-admin2 .modal-title').text("Deletar Tempo de Empréstimo:");
     				var thisElement = this;
     				var tipo = 'tempo-form-delete';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('#modal-admin2 .modal-body').html(retorno);
		     				$('#button-model-deletar').val("Sim!");
		     				$('#button-model-deletar #bt-value').text("Sim!");
     						$('.hide-id-form').val(retornaID(thisElement));
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-create-reserva'){
     				$('#modal-reserva .modal-title').text("Criar Reserva:");
     				var thisElement = this;
     				var tipo = 'reserva-form';
     				$.ajax({
     					type: 'POST',
     					url: 'controller/modal.php',
     					data: 'tipo='+tipo,
     					success: function(retorno){
     						$('#modal-reserva  .reserva-body').html(retorno);
		     				$('#button-model').val("Criar");
		     				$('#button-model #bt-value').text("Criar");
     						retornaCampos(thisElement);
     						$('.hide-id-form').val(retornaID(thisElement));
     					},
		                error: function(XMLHttpRequest, textStatus, errorThrown) {
		                	alert(XMLHttpRequest +" || "+ textStatus + " || " + errorThrown);
		                }
     				});

     			}else if(this.id=='bt-create'){
     				$('.modal-title').text("Criar novo Título:");
     				$('#button-model').val("Criar");
     				$('#button-model #bt-value').text("Criar");
     			  	$('form').trigger("reset");

     			}else if(this.id=='bt-update'){
     				$('.modal-title').text("Atualizar Título:");
     				$('#button-model').val("Atualizar");
     				$('#button-model #bt-value').text("Atualizar");
     				// retona os valores aos campos
     				retornaCampos(this);
					id_selecionado = retornaID(this);

     			}else if(this.id=='bt-delete-titulo'){
     				$('#button-model-deletar').val("Sim!");
     				$('#button-model-deletar #bt-value').text("Sim!");
     				id_selecionado = retornaID(this);

     			}else if(this.id=='bt-delete-exemplar'){
     				$('#button-model-deletar').val("Sim!");
     				$('#button-model-deletar #bt-value').text("Sim!");
     				id_selecionado = retornaID(this);

     			}else if(this.id=='bt-create-exemplar'){
     			  	$('form').trigger("reset");
     				$('.modal-title').text("Criar novo Exemplar:");
     				$('#button-model').val("Criar");
     				$('#button-exemplar #bt-value').text("Criar");
     				retornaCampos(this);
     				id_selecionado = retornaID(this);

     			}else if(this.id=='bt-acervo'){
     				$('.modal-title').text("Acervo:");

     			}else if(this.id=='bt-update-exemplar'){
     				$('.modal-title').text("Atualizar Exemplar:");
     				$('#button-exemplar').val("Atualizar");
     				$('#button-exemplar #bt-value').text("Atualizar");
     				retornaCampos(this);
     				id_selecionado = retornaID(this);

     			}else if(this.id=='bt-create-leitor'){
					$("#nascimento-form").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
					$("#cpf-form").mask("999.999.999-99");
					$("#cep-form").mask("99999-999");
     				$('.modal-title').text("Criar novo Leitor:");
     				$('#button-leitor').val("Criar");
     				$('#button-leitor #bt-value').text("Criar");
     			  	$('form').trigger("reset");

     			}else if(this.id=='bt-delete-leitor'){
     				$('#button-model-deletar').val("Sim!");
     				$('#button-model-deletar #bt-value').text("Sim!");
     				id_selecionado = retornaID(this);

     			}else if(this.id=='bt-update-leitor'){
					$("#nascimento-form").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
					$("#cpf-form").mask("999.999.999-99");
					$("#cep-form").mask("99999-999");
     				$('.modal-title').text("Atualizar Leitor:");
     				$('#button-leitor').val("Atualizar");
     				$('#button-leitor #bt-value').text("Atualizar");
     				retornaCampos(this);
     				id_selecionado = retornaID(this);

     			}
     		});

			/*
			Funções
			------------------------------------------------------
			*/
			   

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

     		//retorna os campos para edição
			function retornaCampos(selecionado){
				// Se o id do selecionado
				if(selecionado.id=='bt-update'){
					//var index
					var titulo = $(selecionado).closest('tr.row-tabela').find('.hide-titulo').val();
					var autor = $(selecionado).closest('tr.row-tabela').find('.hide-autor').val();
					var tipo = $(selecionado).closest('tr.row-tabela').find('.hide-tipo').val();
					var descricao = $(selecionado).closest('tr.row-tabela').find('.hide-descricao').val();
					
					$('#titulo-form').val(titulo);
					$('#autor-form').val(autor);
					$('#tipo-form').val(tipo);
					$('#descricao-form').val(descricao);

				}else if (selecionado.id=='bt-create-exemplar'){
					//var index
					var titulo = $(selecionado).closest('tr.row-tabela').find('.hide-titulo').val();
					var tipo = $(selecionado).closest('tr.row-tabela').find('.hide-tipo').val();
					$('#titulo-exemplar-form').val(titulo);
					$('#tipo-exemplar-form').val(tipo);

				}else if (selecionado.id=='bt-update-exemplar'){
					//var acervo
					var chamada = $(selecionado).closest('tr.row-tabela').find('.hide-chamada').val();
					var volume = $(selecionado).closest('tr.row-tabela').find('.hide-volume').val();
					var edicao = $(selecionado).closest('tr.row-tabela').find('.hide-edicao').val();
					var ano = $(selecionado).closest('tr.row-tabela').find('.hide-ano').val();
					var isbn = $(selecionado).closest('tr.row-tabela').find('.hide-isbn').val();
					var editora = $(selecionado).closest('tr.row-tabela').find('.hide-editora').val();
					var cidade = $(selecionado).closest('tr.row-tabela').find('.hide-cidade').val();
					var descricao_fisica = $(selecionado).closest('tr.row-tabela').find('.hide-descricao-fisica').val();

					$('#chamada-exemplar-form').val(chamada);
					$('#volume-exemplar-form').val(volume);
					$('#edicao-exemplar-form').val(edicao);
					$('#ano-exemplar-form').val(ano);
					$('#isbn-exemplar-form').val(isbn);
					$('#editora-exemplar-form').val(editora);
					$('#cidade-exemplar-form').val(cidade);
					$('#descricao-form').val(descricao_fisica);
				}
				else if (selecionado.id=='bt-update-leitor'){
					//var leitor
					var nome = $(selecionado).closest('tr.row-tabela').find('.hide-nome').val();
					var email = $(selecionado).closest('tr.row-tabela').find('.hide-email').val();
					var cpf = $(selecionado).closest('tr.row-tabela').find('.hide-cpf').val();
					var rg = $(selecionado).closest('tr.row-tabela').find('.hide-rg').val();
					var nascimento = $(selecionado).closest('tr.row-tabela').find('.hide-nascimento').val();
					var sexo = $(selecionado).closest('tr.row-tabela').find('.hide-sexo').val();
					var cidade = $(selecionado).closest('tr.row-tabela').find('.hide-cidade').val();
					var cep= $(selecionado).closest('tr.row-tabela').find('.hide-cep').val();
					var bairro = $(selecionado).closest('tr.row-tabela').find('.hide-bairro').val();
					var rua = $(selecionado).closest('tr.row-tabela').find('.hide-rua').val();
					var num = $(selecionado).closest('tr.row-tabela').find('.hide-num').val();
					var comp = $(selecionado).closest('tr.row-tabela').find('.hide-comp').val();

					$('#nome-form').val(nome);
					$('#email-form').val(email);
					$('#cpf-form').val(cpf);
					$('#rg-form').val(rg);
					$('#nascimento-form').val(nascimento);
					$('#sexo-form').val(sexo);
					$('#cidade-form').val(cidade);
					$('#cep-form').val(cep);
					$('#bairro-form').val(bairro);
					$('#rua-form').val(rua);
					$('#num-form').val(num);
					$('#comp-form').val(comp);
				}
				else if (selecionado.id=='bt-update-multa'){
					//var multa
					var nome = $(selecionado).closest('tr.row-tabela').find('.hide-nome').val();
					var valor = $(selecionado).closest('tr.row-tabela').find('.hide-valor').val();

					$('#multa-nome').val(nome);
					$('#multa-valor').val(valor);
				}
				else if (selecionado.id=='bt-update-tempo'){
					//var multa
					var nome = $(selecionado).closest('tr.row-tabela').find('.hide-nome').val();
					var dias = $(selecionado).closest('tr.row-tabela').find('.hide-dias').val();

					$('#tempo-nome').val(nome);
					$('#tempo-dias').val(dias);
				}
				else if (selecionado.id=='bt-create-reserva'){
					//var index
					var titulo = $(selecionado).closest('tr.row-tabela').find('.hide-titulo').val();
					var chamada = $(selecionado).closest('tr.row-tabela').find('.hide-chamada').val();
					$('#titulo-reserva-form').val(titulo);
					$('#chamada-reserva-form').val(chamada);
				}
			}

			//retorna o ID para edição
			function retornaID(selecionado){
				var id = $(selecionado).closest('tr.row-tabela').find('.hide-id').val();
				return id;
			}

}); 