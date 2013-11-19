$.fx.speeds._default = 500;// define a velocidade default dos efeitos 
function mostrarAviso(texto, tipo) {
  if(tipo == "aviso") {
	  $('#aviso_formulario').removeClass('ui-state-error').addClass('ui-state-highlight'); 
  }else{
	  $('#aviso_formulario').removeClass('ui-state-highlight').addClass('ui-state-error'); 
  }
  $('#avisos').show('blind');
  tips = $('.validateTips');
  tips.text(texto);
  setTimeout('removerAviso()',5000);
}

function removerAviso() 
{
  $('#avisos').hide('blind');
}

function mostrarAviso2(texto, tipo) {
	  if(tipo == "aviso") {
		  $('#aviso_formulario').removeClass('ui-state-error').addClass('ui-state-highlight'); 
	  }else{
		  $('#aviso_formulario').removeClass('ui-state-highlight').addClass('ui-state-error'); 
	  }
	  $('#avisos').show('blind');
	  tips = $('.validateTips');
	  tips.text(texto);
	}
function removerAviso2() 
{
  $('#avisos').hide();
}

function logar(){
	  
	 var login = $('#login').val();
	 var senha = $('#senha').val();
    $.ajax({
      url : 'controllers/auth.php',
      type: 'POST',
      dataType: 'html',
      data : ({'login': login,'senha':senha}),
      success: function(data) {
    	 var result = data.replace(/^\s+|\s+$/g,"");
		    if(result == "PROFESSOR"){
      			window.location = 'views/professor/index.php';
	        }else if(result == "ALUNO"){
	        	window.location = 'views/aluno/index.php';
		    }else if(result == "ADMIN"){
		    	window.location = 'views/index.php';
			}else{
				mostrarAviso("Usuário não encontrado, Login ou Senha incorretos!",'erro');
			}
      }
    });
  }

function verificaLogin(obj){
	var login = $(obj).val();
	var loginOld = $('#loginOld').val();
	if((login != '') && (login != loginOld)){
	  $.ajax({
	       url : '../helper/verificaLoginIgual.php',
	       type: 'GET',
	       dataType: 'html',
	       data : ({'login': login}),
	       success: function(data) {
	    	   if(data == 'loginIgual'){
	    		   $('#salvar-button').attr('disabled',true);
	    		   $(obj).addClass("ui-state-error");
	    		   $(obj).focus();
	        		mostrarAviso2("Já existe um usuario com este Login, por favor altere o login!",'error');
	    	   }else{
	    		   $('#salvar-button').removeAttr('disabled');
		        	removerAviso2();
		        	$(obj).removeClass("ui-state-error");
	    	   }
	       }
	     });
	  }else{
		  $('#salvar-button').removeAttr('disabled');
      	  removerAviso2();
      	$(obj).removeClass("ui-state-error");
	  }
	 
}

//  Validação formulários 
function testaCampo(obj, tipo, mensagem, aviso)
{
  obj = $(obj);
  switch(tipo){
    case 'texto':
      if (obj.val()=='') {
    	$('#salvar-button').attr('disabled',true);
        obj.addClass("ui-state-error");
        if(!mensagem) {
          //Mensagem padrão
          mensagem = "Item Obrigatório";
        } 
        obj.focus();
        mostrarAviso2(mensagem, aviso);
      } else {
    	$('#salvar-button').removeAttr('disabled');
    	removerAviso2();
        obj.removeClass("ui-state-error");
      }
      break;
    case 'cpf':
        cpf = obj.val();
    	cpf = cpf.replace(/[.\-]/g,"");
       if(cpf.length != 11 ){
    	   $('#salvar-button').attr('disabled',true);
        	obj.addClass("ui-state-error");
            if(!mensagem) {
                //Mensagem padrão
                mensagem = "Tamanho do CPF incorreto";
            } 
            $('#salvar-button').removeAttr('disabled');
            obj.focus();
            mostrarAviso2(mensagem, aviso);
        }else{
       
	       dv = cpf.substr(cpf.length-2,cpf.length);
	       cpf = cpf.substr(0,9);
	       /*calcular 1º dv*/
	       soma = 0;
	       for(i = 0;i < 9; i++){
	           soma += cpf[i]*(i+1);
	       }
	       dv1 = soma%11;
	       /*calcular 2º dv*/
	       soma = 0;
	       for(i = 0; i < 9; i++){
	           soma += cpf[i]*i;
	       }
	       soma += dv1*9;
	       dv2 = soma%11;
	       digito = dv1+""+dv2;
	       if(dv == digito){ /*compara o dv digitado ao dv calculado*/
	    	   $('#salvar-button').removeAttr('disabled');
	    	   removerAviso2();
	           obj.removeClass("ui-state-error");
	       }else{
	    	   obj.addClass("ui-state-error");
	            if(!mensagem) {
	                //Mensagem padrão
	                mensagem = "Cpf incorreto";
	            } 
	            $('#salvar-button').removeAttr('disabled');
	            obj.focus();
	            mostrarAviso2(mensagem, aviso);
	       }
        }
      break;
      case 'cnpj':
    	  cnpj = obj.val();
    	  cnpj = cnpj.replace(/[.\-\/]/g,"");
    	  
    	  if(cnpj.length != 14 ){
    		  $('#salvar-button').attr('disabled',true);
          	obj.addClass("ui-state-error");
              if(!mensagem) {
                  //Mensagem padrão
                  mensagem = "Tamanho do CNPJ incorreto";
              }
              obj.focus();
              mostrarAviso2(mensagem, aviso);
              bloquearSalvar = true;
          }else{
    	  	dv = cnpj.substr(cnpj.length-2,cnpj.length);
    	    cnpj = cnpj.substr(0,12);
    	    /*calcular 1º dígito verificador*/
    	    soma;
    	    soma = cnpj[0]*6;
    	    soma += cnpj[1]*7;
    	    soma += cnpj[2]*8;
    	    soma += cnpj[3]*9;
    	    soma += cnpj[4]*2;
    	    soma += cnpj[5]*3;
    	    soma += cnpj[6]*4;
    	    soma += cnpj[7]*5;
    	    soma += cnpj[8]*6;
    	    soma += cnpj[9]*7;
    	    soma += cnpj[10]*8;
    	    soma += cnpj[11]*9;
    	    v1 = soma%11;
    	    if (dv1 == 10){
    	        dv1 = 0;
    	    }
    	    /*calcular 2º dígito verificador*/
    	    soma = cnpj[0]*5;
    	    soma += cnpj[1]*6;
    	    soma += cnpj[2]*7;
    	    soma += cnpj[3]*8;
    	    soma += cnpj[4]*9;
    	    soma += cnpj[5]*2;
    	    soma += cnpj[6]*3;
    	    soma += cnpj[7]*4;
    	    soma += cnpj[8]*5;
    	    soma += cnpj[9]*6;
    	    soma += cnpj[10]*7;
    	    soma += cnpj[11]*8;
    	    soma += dv1*9;
    	    dv2 = soma%11;
    	    if (dv2 == 10){
    	        dv2 = 0;
    	    }
    	    digito = dv1+""+dv2;
    	    if(dv == digito){ /*compara o dv digitado ao dv calculado*/
    	    	 removerAviso2();
	  	         obj.removeClass("ui-state-error");
    	    }else{
    	    	obj.addClass("ui-state-error");
 	            if(!mensagem) {
 	                //Mensagem padrão
 	                mensagem = "CNPJ incorreto";
 	            } 
 	            obj.focus();
 	            mostrarAviso2(mensagem, aviso);
    	    }
         }
      break;
      //TODO REVER O SCRIPT DO CEP
      case 'cep':
    	  cep = obj.val();
    	  //retira os espaços do cep
    	  cep = cep.replace(/^\s+|\s+$/g, '');
    	  
    	  if(cep.length != 8){
    		  $('#salvar-button').attr('disabled',true);
          	obj.addClass("ui-state-error");
              if(!mensagem) {
                  //Mensagem padrão
                  mensagem = "Tamanho do CEP incorreto";
              } 
              obj.focus();
              mostrarAviso2(mensagem, aviso);
              bloquearSalvar = true;
          }else{
    	  	validador = /^[0-9]{2}\.[0-9]{3}-[0-9]{3}$/;
    	  	 if(validador.test(cep)){
    	  		$('#salvar-button').removeAttr('disabled');
    	  		 removerAviso2();
	  	         obj.removeClass("ui-state-error");
    	  	 }else{
    	  		$('#salvar-button').removeAttr('disabled');
    	  		obj.addClass("ui-state-error");
 	            if(!mensagem) {
 	                //Mensagem padrão
 	                mensagem = "CEP incorreto";
 	            }
 	            obj.focus();
 	            mostrarAviso2(mensagem, aviso);
    	  	 }
          }
      break;
      case 'email':
    	  email = obj.val();
    	  if(email != ''){
    	  exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    	  check=/@[\w\-]+\./;
    	  checkend=/\.[a-zA-Z]{2,3}$/;
    	  if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1))
          {
    		  $('#salvar-button').attr('disabled',true);
    		  obj.addClass("ui-state-error");
	            if(!mensagem) {
	                //Mensagem padrão
	                mensagem = "Email incorreto";
	            } 
	            obj.focus();
	            mostrarAviso2(mensagem, aviso);
          }else{
        	  $('#salvar-button').removeAttr('disabled');
        	  removerAviso2();
	  	      obj.removeClass("ui-state-error");
          }
    	  }
      break;

      case'senha':
    	  senha = obj.val();
    	  if(senha !=  ''){
				if(senha.length<6)
				{
					$('#salvar-button').attr('disabled',true);
					 obj.addClass("ui-state-error");
			            if(!mensagem) {
			                //Mensagem padrão
			                mensagem = "A senha deve conter no mínimo seis caracteres";
			            } 
			            obj.focus();
			            mostrarAviso2(mensagem, aviso);
				}else{
					$('#salvar-button').removeAttr('disabled');
					 removerAviso2();
			  	      obj.removeClass("ui-state-error");
				}
        	}else{
        		obj.addClass("ui-state-error");
	            if(!mensagem) {
	                //Mensagem padrão
	                mensagem = "A Senha não pode ser vazia";
	            } 
	            obj.focus();
	            mostrarAviso2(mensagem, aviso);
            }
      break;

      case 'data':
    	  obj.datepicker({ changeYear: true,
        	  			   yearRange: "1900",
                     buttonImage: "public/images/add.png",
        	  			   dateFormat: "dd-mm-yy"});
        obj.datepicker($.datepicker.regional['pt-BR']);
      break;
      case 'login':
          if (obj.val()=='') {
        	$('#salvar-button').attr('disabled',true);
            obj.addClass("ui-state-error");
            if(!mensagem) {
              //Mensagem padrão
              mensagem = "Item Obrigatório";
            } 
            obj.focus();
            mostrarAviso2(mensagem, aviso);
          } else {
        	verificaLogin(obj);
          }
          break;
      
  }
}

//----------------------MASCARAS---------------------------------//
/*Função Pai de Mascaras*/
   function Mascara(o,f){
       v_obj=o
       v_fun=f
       setTimeout("execmascara()",1)
   }
   
   /*Função que Executa os objetos*/
   function execmascara(){
       v_obj.value=v_fun(v_obj.value)
   }
   
   /*Função que Determina as expressões regulares dos objetos*/
   function leech(v){
       v=v.replace(/o/gi,"0")
       v=v.replace(/i/gi,"1")
       v=v.replace(/z/gi,"2")
       v=v.replace(/e/gi,"3")
       v=v.replace(/a/gi,"4")
       v=v.replace(/s/gi,"5")
       v=v.replace(/t/gi,"7")
       return v
   }
   
   /*Função que permite apenas numeros*/
   function Integer(v){
       return v.replace(/\D/g,"")
   }
   
   /*Função que padroniza telefone (11) 4184-1241*/
   function Telefone(v){
       v=v.replace(/\D/g,"")                 
       v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
       v=v.replace(/(\d{4})(\d)/,"$1-$2")    
       return v
   }
   
   /*Função que padroniza telefone (11) 41841241*/
   function TelefoneCall(v){
       v=v.replace(/\D/g,"")                 
       v=v.replace(/^(\d\d)(\d)/g,"($1) $2")    
       return v
   }
   
   /*Função que padroniza CPF*/
   function Cpf(v){
       v=v.replace(/\D/g,"")                    
       v=v.replace(/(\d{3})(\d)/,"$1.$2")       
       v=v.replace(/(\d{3})(\d)/,"$1.$2")       
                                                
       v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") 
       return v
   }
   
   /*Função que padroniza CEP*/
   function Cep(v){
       v=v.replace(/D/g,"")                
       v=v.replace(/^(\d{5})(\d)/,"$1-$2") 
       return v
   }
   
   /*Função que padroniza CNPJ*/
   function Cnpj(v){
       v=v.replace(/\D/g,"")                   
       v=v.replace(/^(\d{2})(\d)/,"$1.$2")     
       v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") 
       v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           
       v=v.replace(/(\d{4})(\d)/,"$1-$2")              
       return v
   }
   
   /*Função que permite apenas numeros Romanos*/
   function Romanos(v){
       v=v.toUpperCase()             
       v=v.replace(/[^IVXLCDM]/g,"") 
       
       while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
           v=v.replace(/.$/,"")
       return v
   }
   
   /*Função que padroniza o Site*/
   function Site(v){
       v=v.replace(/^http:\/\/?/,"")
       dominio=v
       caminho=""
       if(v.indexOf("/")>-1)
           dominio=v.split("/")[0]
           caminho=v.replace(/[^\/]*/,"")
           dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
           caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
           caminho=caminho.replace(/([\?&])=/,"$1")
       if(caminho!="")dominio=dominio.replace(/\.+$/,"")
           v="http://"+dominio+caminho
       return v
   }

   /*Função que padroniza DATA*/
   function Data(v){
       v=v.replace(/\D/g,"") 
       v=v.replace(/(\d{2})(\d)/,"$1/$2") 
       v=v.replace(/(\d{2})(\d)/,"$1/$2") 
       return v
   }
   
   /*Função que padroniza DATA*/
   function Hora(v){
       v=v.replace(/\D/g,"") 
       v=v.replace(/(\d{2})(\d)/,"$1:$2")  
       return v
   }
   
   /*Função que padroniza valor monétario*/
   function Valor(v){
       v=v.replace(/\D/g,"") //Remove tudo o que não é dígito
       v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
       //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
       v=v.replace(/(\d)(\d{2})$/,"$1.$2") //Coloca ponto antes dos 2 últimos digitos
       return v
   }
   
   /*Função que padroniza Area*/
   function Area(v){
       v=v.replace(/\D/g,"") 
       v=v.replace(/(\d)(\d{2})$/,"$1.$2") 
       return v
       
   }
//-----------------------------FIM MÁSCARAS---------------------------------------//
   
   function montaArrayCheckButton(div){
		 
	   inputs = $('#'+div+' :input');
	   var i = 0;
	   var values = '{';
	   inputs.each(function() {
	   	if($(this).attr('type') == 'checkbox') {
	   		if($(this).is(":checked")){
	   			values += '"'+i+'":"'+$(this).val()+'",'; i++;
	   		}
	     }
	   });
	   values += '}';
	   if(values != '{}'){
		   return $.parseJSON($.trim(values.substring(values.length-2, -2)+"}")); 
	   }else{
		   return 0; 
	   }
	 }
   
   function montaArrayProf(form){
		 
	   inputs = $('#'+form+' :input');
	   var values = '{';
	   inputs.each(function() {
	   	if($(this).val() != '' && $(this).attr('type') != 'checkbox') {
	   		values += '"'+this.name+'":"'+$(this).val()+'",'; 
	     } 
	   });
	   values += '}';
	   
	   return $.parseJSON($.trim(values.substring(values.length-2, -2)+"}")); 
	 }
   
   function montaArray(formulario){
		 
	   inputs = $('#'+formulario+' :input');
	   
	   var values = '{';
	   inputs.each(function() {
	   	if($(this).val()!='') {
	       values += '"'+this.name+'":"'+$(this).val()+'",';
	     }
	   });
	   values += '}';
	   return $.parseJSON($.trim(values.substring(values.length-2, -2)+"}")); 
	 }
	 // ####
	 // ### pegaNome(pai)
	 /**
	  *  Retorna o value do <input> name="nome";
	  */
	 function pegaNome(formulario)
	 {
	   nomeItem = '';
	   inputs = $('#'+formulario+' :input');
	   inputs.each(function() {
	     if(this.name=='nome') {
	       nomeItem = $(this).val();
	       //alert(nomeItem);
	     }
	   });
	   if(nomeItem) {
	   	return nomeItem;
	   } 
	   return nomeItem;
	    
	 }
	
	 function enviaFormulario(form, resposta)
	 {
	 	 
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArray(formulario);
	   
	   $.ajax({
	     url : action,
	     type: 'POST',
	     dataType: 'json',
	     data: values,
	     success: function(data) {
	    	 if(data){
	    		 $('#page').load(resposta+'?m=1&id='+data);
	    	 }else{
	    		 $('#page').load(resposta+'?m=1');
	    	 }
	    	 mostrarAviso("Registro Cadastrado com sucesso!",'aviso');
	     }
	   });
	 }
   
	 function enviaFormularioEditar(form, resposta)
	 {
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArray(formulario);
	  
	   $.ajax({
	     url : action,
	     type: 'POST',
	     dataType: 'json',
	     data: values,
	     success: function(data) {
	       $('#page').load(resposta+'?m=1');// recarrega a pagina 
	       mostrarAviso("Item Alterado com Sucesso!",'aviso');
	     }
	   });
	 }
	 
	 function enviaFormularioBol(form, resposta)
	 {
	 	 
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArray(formulario);
	  
	   $.ajax({
	     url : action,
	     type: 'POST',
	     dataType: 'json',
	     data: values,
	     success: function(data) {
	    	 if(data.x == 0){
	    		 $('#page').load(data.load);
	    		 mostrarAviso("Ja existe um boletim deste aluno com esta serie e esta etapa!",'error');
	    	 }else{
		    	 $('#page').load(data.load);
		    	 mostrarAviso("Registro Cadastrado com sucesso!",'aviso');
	    	 }
	     }
	   });
	 }
	 
	 /*function enviaFormularioImagem(form, resposta)
	 {
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArray(formulario);
	   
	   $.ajaxFileUpload({
	     url : action,
	     secureuri:false, 
		 fileElementId:'foto',
	     type: 'POST',
	     dataType: 'json',
	     data: values,
	     success: function(data) {
	    	 if(data){
	    		 alert(data);
	    	 }else{
	    		 $('#page').load(resposta+'?m=1');
	    	 	mostrarAviso("Registro Cadastrado com sucesso!",'aviso');
	    	 }
	     }
	   });
	 }*/
	 
	 function enviaFormularioProf(form, resposta)
	 {
	 	 
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArrayProf(formulario);
	   materias = montaArrayCheckButton('materias');//div das materias
	   turmas = montaArrayCheckButton('turmas');//div das turmas
	  
	   $.ajax({
		     url : action,
		     type: 'POST',
		     dataType: 'json',
		     data: {'0':values,'1':materias,'2':turmas},
		     success: function(data) {
		       $('#page').load(resposta+'?m=1');// recarrega a pagina 
	    	 mostrarAviso("Item Cadastrado com sucesso!",'aviso');
	     }
	   });
	 }
   
	 function enviaFormularioEditarProf(form, resposta)
	 {
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArrayProf(formulario);
	   materias = montaArrayCheckButton('materias');//div das materias
	   turmas = montaArrayCheckButton('turmas');//div das turmas
	   
	   $.ajax({
	     url : action,
	     type: 'POST',
	     dataType: 'json',
	     data: {'0':values,'1':materias,'2':turmas},
	     success: function(data) {
	       $('#page').load(resposta+'?m=1');// recarrega a pagina 
	       mostrarAviso("Item Alterado com Sucesso!",'aviso');
	     }
	   });
	 }
	 
	 
	 function enviaFormularioTurma(form, resposta)
	 {
	 	 
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArrayProf(formulario);
	   materias = montaArrayCheckButton('materias');//div das materias
	  
	   $.ajax({
		     url : action,
		     type: 'POST',
		     dataType: 'json',
		     data: {'0':values,'1':materias},
		     success: function(data) {
		       $('#page').load(resposta+'?m=1');// recarrega a pagina 
	    	 mostrarAviso("Item Cadastrado com sucesso!",'aviso');
	     }
	   });
	 }
   
	 function enviaFormularioEditarTurma(form, resposta)
	 {
	   action     = $(form).attr('action');
	   formulario = $(form).attr('id');
	   nomeItem   = pegaNome(formulario);
	   values     = montaArrayProf(formulario);
	   materias = montaArrayCheckButton('materias');//div das materias

	   $.ajax({
	     url : action,
	     type: 'POST',
	     dataType: 'json',
	     data: {'0':values,'1':materias},
	     success: function(data) {
	       $('#page').load(resposta+'?m=1');// recarrega a pagina 
	       mostrarAviso("Item Alterado com Sucesso!",'aviso');
	     }
	   });
	 }
	 
	 
   function excluirRegistro(id, action, resposta, idAluno)
   {
     $.ajax({
       url : action,
       type: 'GET',
       dataType: 'json',
       data : ({'id': id,'funcao':'excluir'}),
       success: function(data) {
    	   if(data == 1){
    		   if(idAluno != '')
    			   $('#page').load(resposta+'?m=1&idaln='+idAluno);
    		   else
    			   $('#page').load(resposta+'?m=1');
	    	   mostrarAviso("Registro Excluído com Sucesso!",'aviso');
       		}else{
       		   mostrarAviso("Não foi possível excluir o registro",'erro');
       		}
    	   //window.location = resposta;
       }
     });
   }
   /**
    * Funcao para abrir dialog de excluir
    * @author Edmo Farias
    * @version 0.1
   **/
   function excluirCadastro(idBotao,id)
   {
     //action para o Ajax passado na montagem do formulário 
     action = $('#'+idBotao).attr('action')||''; 
     //Titulo passado na montagem do formulário 
     titulo  = $('#'+idBotao).attr('titulo')||'Aviso!'; 
     //Id Da caixa dialog 
     nomeCaixa = $('#'+idBotao).attr('caixa')||'dialog_excluir';
     resposta = $('#'+idBotao).attr('resposta')||'';
     idAluno = $('#'+idBotao).attr('idaluno')||'';

     if($('#'+nomeCaixa).is('dialog')) { 
       $('#'+nomeCaixa).dialog('open'); 
     }else{
       $('#'+nomeCaixa+'_texto').html("Tem certeza que deseja excluir este registro?");
       $('#'+nomeCaixa).dialog({
         title: titulo,
         width: 'auto',
         height: 'auto',
         position: "center",
         modal: true,
         buttons: {
          /* "Sim": function() {
             excluirRegistro(id,action,resposta,idAluno);
             $(this).dialog('destroy'); // fecha ao dialog de confirmação de pois do OK da mensagem "excluido com sucesso"
           },*/
           "Não": function() {
             $(this).dialog("destroy");
           }
         }
       });
     }
   }
   
   function gerarBoletins(idTurma)
   {
     var nomeCaixa = 'escolher_etapa';

     if($('#'+nomeCaixa).is('dialog')) { 
       $('#'+nomeCaixa).dialog('open'); 
     }else{
       $('#'+nomeCaixa).dialog({
         title: 'Escolha a etapa para gerar os boletins',
         width: 'auto',
         height: 'auto',
         position: 'center',
         modal: true,
         buttons: {
           "Gerar": function() {
        	   
        	   var etapa = $('#etapa_boletins').val(); 
        	   if(etapa != '' && etapa > 0	){
	        	   $.ajax({
	        	       url : '../controllers/boletimTurma.php',
	        	       type: 'POST',
	        	       dataType: 'json',
	        	       data : ({'turma': idTurma,'etapa':etapa}),
	        	       success: function(data) {
	        	    	   $('#page').load('listaTurma.php?m=1');
	        		    	 mostrarAviso(data.msg,'aviso');
	        	       }
	        	     });
	        	   
	        	   $(this).dialog('destroy'); // fecha ao dialog de confirmação de pois do OK da mensagem "excluido com sucesso"
	        	   
               }else{
            	   alert('Escolha a etapa para gerar os boletins');
               }
           },
           'Cancelar': function() {
             $(this).dialog("destroy");
           }
         }
       });
     }
   }
   
   function confirmarBoletins(idTurma)
   {
     var nomeCaixa = 'escolher_acao';

     if($('#'+nomeCaixa).is('dialog')) { 
       $('#'+nomeCaixa).dialog('open'); 
     }else{
       $('#'+nomeCaixa).dialog({
         title: 'Confirmar / Não Confirmar Boletins',
         width: 'auto',
         height: 'auto',
         position: 'center',
         modal: true,
         buttons: {
           "Executar": function() {
        	   
        	   var etapa = $('#etapa_confirmar').val();
        	   var acao = $('#confirmar_nConfirmar').val();
        	   
        	   if(etapa != '' && etapa > 0	){
	        	   $.ajax({
	        	       url : '../controllers/confirmarBoletinsTurma.php',
	        	       type: 'POST',
	        	       dataType: 'json',
	        	       data : ({'turma': idTurma,'etapa':etapa,'acao':acao}),
	        	       success: function(data) {
	        	    	   $('#page').load('listaTurma.php?m=1');
	        		    	 mostrarAviso(data.msg,'aviso');
	        	       }
	        	     });
	        	   
	        	   $(this).dialog('destroy'); // fecha ao dialog de confirmação de pois do OK da mensagem "excluido com sucesso"
	        	   
               }else{
            	   alert('Escolha a etapa para gerar os boletins');
               }
           },
           'Cancelar': function() {
             $(this).dialog("destroy");
           }
         }
       });
     }
   }
   
   function listarRanking()
   {
     var nomeCaixa = 'escolher_etapa';

     if($('#'+nomeCaixa).is('dialog')) { 
       $('#'+nomeCaixa).dialog('open'); 
     }else{
       $('#'+nomeCaixa).dialog({
         title: 'Escolha a etapa para visualizar o ranking de alunos',
         width: 'auto',
         height: 'auto',
         position: 'center',
         modal: true,
         buttons: {
           "Listar": function() {
        	   
        	   var etapa = $('#etapa_boletins').val(); 
        	   if(etapa != '' && etapa > 0	){
	        	   window.location='rankingGeralAlunos.php?etapa='+etapa;
	        	   $(this).dialog('destroy'); // fecha ao dialog de confirmação de pois do OK da mensagem "excluido com sucesso"
               }else{
            	   alert('Escolha uma etapa');
               }
           },
           'Cancelar': function() {
             $(this).dialog("destroy");
           }
         }
       });
     }
   }
