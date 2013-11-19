function vazio(str){
	wd = str.length;
	cont = 0;
	for (x=0; x<wd; x++){
		if (str.substring(x,x+1) == " ") { ++ cont; }
	}
	return ((cont == wd) || (str == ""));
}

function mostraAviso(obj)
{
	$('#'+$(obj).attr('id')+'_aviso').html('[Inválido]').attr('style','color: red;');
    $(obj).attr('style','border: 1px solid red;');
    $(obj).focus();
}

function removeAviso(obj)
{
	if($(obj).val() != '' )
	{
		$('#'+$(obj).attr('id')+'_aviso').removeAttr('style').html('');
    	$(obj).removeAttr('style');
	}
}

//  Validação formulários 
function validarCampo(obj, tipo)
{
  obj = $(obj);
  switch(tipo)
  {
  	case 'texto':
      if (vazio(obj.val())) 
      {
      	
      	mostraAviso(obj);
      	return 0;
      }
       else 
      {
      	
    	removeAviso(obj);
    	return 1;
      }
      break;
    case 'cpf':
        cpf = obj.val();
    	cpf = cpf.replace(/[.\-]/g,"");
       if(cpf.length != 11 )
       {
       	
        	mostraAviso(obj);
        	return 0;
        }
        else
        {
       
	       dv = cpf.substr(cpf.length-2,cpf.length);
	       cpf = cpf.substr(0,9);
	       /*calcular 1º dv*/
	       soma = 0;
	       for(i = 0;i < 9; i++)
	       {
	           soma += cpf[i]*(i+1);
	       }
	       dv1 = soma%11;
	       /*calcular 2º dv*/
	       soma = 0;
	       for(i = 0; i < 9; i++)
	       {
	           soma += cpf[i]*i;
	       }
	       soma += dv1*9;
	       dv2 = soma%11;
	       digito = dv1+""+dv2;
	       if(dv == digito)
	       { /*compara o dv digitado ao dv calculado*/
	    	
	    	  removeAviso(obj);
	    	  return 1;
	       }
	       else
	       {
	       	
	    	  mostraAviso(obj);
	    	  return 0;
	    	  
	       }
        }
      break;
      case 'cnpj':
    	  cnpj = obj.val();
    	  cnpj = cnpj.replace(/[.\-\/]/g,"");
    	  
    	  if(cnpj.length != 14 )
    	  {
    	  	
          	 mostraAviso(obj);
          	 return 0;
          }
          else
          {
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
    	    if(dv == digito)
    	   { /*compara o dv digitado ao dv calculado*/
    	  	
    	    	removeAviso(obj);
    	    	return 1;
    	    }
    	    else
    	    {
    	    	
    	    	 mostraAviso(obj);
    	    	 return 0;
    	    }
         }
      break;

      case 'email':
    	  email = obj.val();
    	  exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    	  check=/@[\w\-]+\./;
    	  checkend=/\.[a-zA-Z]{2,3}$/;
    	  if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1))
          {
          	
    		 mostraAviso(obj);
    		 return 0;
          }
          else
          {
          	
        	  removeAviso(obj);
        	  return 1;
          }
      break;

      case 'data':
        var bissexto = 0;
        var data = obj.val();
        var tam = data.length;
        if (tam == 10) 
        {
                var dia = data.substr(0,2)
                var mes = data.substr(3,2)
                var ano = data.substr(6,4)
                if ((ano > 1900)||(ano < 2100))
                {
                        switch (mes) 
                        {
                                case '01':
                                case '03':
                                case '05':
                                case '07':
                                case '08':
                                case '10':
                                case '12':
                                        if  (dia <= 31) 
                                        {
                                             removeAviso(obj);
                                             return 1;
                                        }
                                        break
                                
                                case '04':              
                                case '06':
                                case '09':
                                case '11':
                                        if  (dia <= 30) 
                                        {
                                                removeAviso(obj);
                                                return 1;
                                        }
                                        break
                                case '02':
                                        /* Validando ano Bissexto / fevereiro / dia */ 
                                        if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)) 
                                        { 
                                                bissexto = 1; 
                                        } 
                                        if ((bissexto == 1) && (dia <= 29)) 
                                        { 
                                                removeAviso(obj); 
                                                return 1;                           
                                        } 
                                        else if ((bissexto != 1) && (dia <= 28)) 
                                        { 
                                                removeAviso(obj);
                                                return 1;
                                        }
                                        else
                                        {
                                        	mostraAviso(obj);
                                        	return 0;
                                        }
                                        break
                                default:
                                	mostraAviso(obj);
                                	return 0;
                                break                                          
                        }
                }
                else
                {
                	mostraAviso(obj);
                	return 0;
                }
        }
        else
        {
        	mostraAviso(obj);
        	return 0;
        }
      break;
      
  }
}

function verificarCampos(form,resposta,tipo)
{
  inputs = $(form+' :input');
  var x = 1;
  var str = '';
  var campo;
  inputs.each(function() {
  	if(x == 1)
  	{
  		str = $(this).val();
	  	if($(this).attr('obrigatorio') == 'true')
	  	{
			if(vazio(str)) /* verifica se a string está vazia*/
			{
				x = validarCampo($(this),'texto');
			}
			else /*se nao estiver vazia verifica se existe validação*/
			{
				switch($(this).attr('validar'))
				{
					case 'nome':
						x = validarCampo($(this),'texto');
						break;
					case 'cpf':
						x = validarCampo($(this),'cpf');
						break;
					case 'data_nascimento':
						x = validarCampo($(this),'data');
						break;
					case 'email':
						x = validarCampo($(this),'email');
						break;
				}
			}
	  	}
    }
 });
  if(x == 0)
  {
  	return false;
  }
  else
  {
	  switch (tipo) {
	  	case 'enviaFormularioBol':
			enviaFormularioBol(form,resposta);
			break;
		case 'enviaFormularioEditar':
			enviaFormularioEditar(form,resposta);
			break;
		case 'enviaFormulario':
			enviaFormulario(form,resposta);
			break;
		case 'enviaFormularioImagem':
			enviaFormularioImagem(form,resposta);
			break;
		case 'enviaFormularioProf':
			enviaFormularioProf(form,resposta);
			break;
		case 'enviaFormularioEditarProf':
			enviaFormularioEditarProf(form,resposta);
			break;
		case 'enviaFormularioEditarTurma':
			enviaFormularioEditarTurma(form,resposta);
			break;
		case 'enviaFormularioTurma':
			enviaFormularioTurma(form,resposta);
			break;
		default:
			return true;
			break;
	 }
  }
}

function verificarCamposAluno(form)
{
  inputs = $(form+' :input');
  var x = 1;
  var str = '';
  inputs.each(function() {
  	if(x == 1)
  	{
  		str = $(this).val();
	  	if($(this).attr('obrigatorio') == 'true')
	  	{
			if(vazio(str)) /* verifica se a string está vazia*/
			{
				x = validarCampo($(this),'texto');
			}
			else /*se nao estiver vazia verifica se existe validação*/
			{
				switch($(this).attr('validar'))
				{
					case 'nome':
						x = validarCampo($(this),'texto');
						break;
					case 'cpf':
						x = validarCampo($(this),'cpf');
						break;
					case 'data_nascimento':
						x = validarCampo($(this),'data');
						break;
					case 'email':
						x = validarCampo($(this),'email');
						break;
				}
			}
	  	}
    }
 });
  if(x == 0)
  {
  	return false;
  }
  
}
