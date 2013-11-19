<?php
include 'headerProf.php';
require_once '../models/db/Conexao.php';

$funcao = "alterar";
if ($_GET['id'])
{
	$funcao = "inserir";
}
?>
<link href="css/form.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="css/pastel.css" />
<style type="text/css">
    .form-label{
        width:100px !important;
    }
    .form-label-left{
        width:100px !important;
    }
    .form-line{
        padding:10px;
    }
    .form-label-right{
        width:100px !important;
    }
    .form-all{
        width:650px;
        background:#FFFFFF;
        color:rgb(82, 75, 58) !important;
        font-family:'Tahoma';
        font-size:13px;
    }
</style>
<h3 id="titulo_pagina" class="titulo_page">Cadastro de Questões</h3>

<form class="jotform-form" action="../../controllers/questionario.php?funcao=<?php echo $funcao ?>" method="post" name="formQuestionario" id="formQuestionario" accept-charset="utf-8">
  <div class="form-all">
    <ul class="form-section">
      <li class="form-line" id="id_4">
        <label class="form-label-top" id="label_4" for="input_4"> Enunciado : </label>
        <div id="cid_4" class="form-input-wide">
          <textarea id="input_4" class="form-textarea" name="q4_enunciado" cols="85" rows="4"></textarea>
        </div>
      </li>
      <li class="form-line" id="id_5">
        <label class="form-label-top" id="label_5" for="input_5"> Resposta Correta : </label>
        <div id="cid_5" class="form-input-wide">
          <input type="text" class="form-textbox" id="input_5" name="q5_respostaCorreta" size="65" />
        </div>
      </li>
      <li class="form-line" id="id_6">
        <label class="form-label-top" id="label_6" for="input_6"> Alternativa 1 : </label>
        <div id="cid_6" class="form-input-wide">
          <input type="text" class="form-textbox" id="input_6" name="q6_alternativa1" size="65" />
        </div>
      </li>
      <li class="form-line" id="id_7">
        <label class="form-label-top" id="label_7" for="input_7"> Alternativa 2 : </label>
        <div id="cid_7" class="form-input-wide">
          <input type="text" class="form-textbox" id="input_7" name="q7_alternativa2" size="65" />
        </div>
      </li>
      <li class="form-line" id="id_8">
        <label class="form-label-top" id="label_8" for="input_8"> Alternativa 3 : </label>
        <div id="cid_8" class="form-input-wide">
          <input type="text" class="form-textbox" id="input_8" name="q8_alternativa3" size="65" />
        </div>
      </li>
      <li class="form-line" id="id_9">
        <label class="form-label-top" id="label_9" for="input_9"> Alternativa 4 : </label>
        <div id="cid_9" class="form-input-wide">
          <input type="text" class="form-textbox" id="input_9" name="q9_alternativa49" size="65" />
        </div>
      </li>
      <li class="form-line form-line-column" id="id_11">
        <label class="form-label-top" id="label_11" for="input_11"> Série : </label>
        <div id="cid_11" class="form-input-wide">
          <select class="form-dropdown" style="width:150px" id="input_11" name="q11_serie">
            <option>  </option>
            <option value="Opção 1"> Opção 1 </option>
            <option value="Opção 2"> Opção 2 </option>
            <option value="Opção 3"> Opção 3 </option>
          </select>
        </div>
      </li>
      <li class="form-line form-line-column" id="id_12">
        <label class="form-label-top" id="label_12" for="input_12"> Materia : </label>
        <div id="cid_12" class="form-input-wide">
          <select class="form-dropdown" style="width:150px" id="input_12" name="q12_materia">
            <option>  </option>
            <option value="1"> 1ᵒ Ano </option>ᵒ
            <option value="2"> 2ᵒ Ano </option>
            <option value="3"> 3ᵒ Ano </option>
            <option value="4"> 4ᵒ Ano </option>
            <option value="5"> 5ᵒ Ano </option>
            <option value="6"> 6ᵒ Ano </option>
            <option value="7"> 7ᵒ Ano </option>
            <option value="8"> 8ᵒ Ano </option>
            <option value="9"> 9ᵒ Ano </option>
            <option value="10"> 1ᵃ Série </option>
            <option value="11"> 2ᵃ Série </option>
            <option value="12"> 3ᵃ Série </option>
            
            <option value="Opção 2"> Opção 2 </option>
            <option value="Opção 3"> Opção 3 </option>
          </select>
        </div>
      </li>
      <li class="form-line form-line-column" id="id_10">
        <label class="form-label-top" id="label_10" for="input_10"> Pontos : </label>
        <div id="cid_10" class="form-input-wide">
          <input type="text" class="form-textbox" id="input_10" name="q10_pontos" size="15" />
        </div>
      </li>
    </ul>
  </div>
</form>
<div id="cid_2" class="form-input-wide">
          <div style="text-align:left" class="form-buttons-wrapper">
            <button id="salvar-button" 
            <?php if($funcao == "inserir"){?>
            	onclick="enviaFormulario('#formQuestionario','listaQuestionario.php');"
            <?php }elseif($funcao == "alterar"){?>
            	onclick="enviaFormularioEditar('#formQuestionario','listaQuestionario.php');"
            <?php }?>
                class="form-submit-button">
              Salvar
            </button>
          </div>
        </div>
