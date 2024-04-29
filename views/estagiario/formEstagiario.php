<div class="container">
  <div >
    <div>
      <a id="voltar" href="?controllers=estagiarioController&method=listar" class="btn btn-secondary mt-2  ">Voltar</a> 
    </div>
  </div> 

    <?php

    if (!$projeto) { 

        echo '<div class="container-fluid mt-5 text-center">
                    <h1 class="text-center">Para Criar ou Associar estagiários é necesserário 
                    existir algum projeto aberto.</h1>
            <a class="btn btn-success mt-3" href="tela.php?controllers=projetoController&method=listar">CRIAR PROJETO</a>
        </div>';
    } else {
    ?>
      <form action="?controllers=estagiarioController&<?php echo isset($estagiario->id_estagiario) ? "method=atualizar&id={$estagiario->id_estagiario}" : "method=salvar"; ?>" method="post" onsubmit="return validarForm()">
            <div class="card border-none" style="top:25px;">
                <div class="card-header rounded-pill mt-2 border border-5 text-center">
                    <span class="card-title fw-bolder">Cadastrar Estagiário</span>
                </div>
                <div class="card-body">
                </div>
                <div class="form-group form-row mt-1 ">
                    <label class=" fw-bolder col-sm-2 col-form-label text-right fw-bolder">Nome:</label>
                    <input type="text" class="text-uppercase form-control col-sm-8" name="nome" id="validationDefault01" value="<?php
                                                                                                                    echo isset($estagiario->nome) ? $estagiario->nome : null;
                                                                                                                    ?>" required />
                </div>
                <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">Valor da Bolsa R$:</label>
                    <input type="number" class="form-control col-sm-8" onchange="setTwoNumberDecimal" min="0" max="" step="0.01" name="valor_bolsa" id="valor_bolsa" value="<?php
                                                                                                                                                                            echo isset($estagiario->valor_bolsa) ? $estagiario->valor_bolsa : 0.00;
                                                                                                                                                                            ?>" required />
                </div>

                <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">Valor do Auxílio R$:</label>
                    <input type="number" class="form-control col-sm-8" onchange="setTwoNumberDecimal" min="0" max="" step="0.01" name="auxilio" id="auxilio" value="<?php
                                                                                                                                                                    echo isset($estagiario->auxilio) ? $estagiario->auxilio : 0.00;
                                                                                                                                                                    ?>" required />
                </div>
                <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">Email:</label>
                    <input type="text" class="form-control col-sm-8" name="email" id="email" value="<?php
                                                                                                    echo isset($estagiario->email) ? $estagiario->email : null;
                                                                                                    ?>" required />
                </div>
                <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">User Name:</label>
                    <input type="text" class="form-control col-sm-8" name="user_name" id="user_name" value="<?php
                                                                                                         echo isset($estagiario->user_name) ? $estagiario->user_name : null;
                                                                                                            ?>" required />
                </div>
                <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">Password:</label>
                    <input type="text" class="form-control col-sm-8" name="password" id="password" value="<?php
                                                                                                            echo isset($estagiario->password) ? $estagiario->password : null;
                                                                                                            ?>" required />
                </div>
                <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">Endereço:</label>
                    <input type="text" class="form-control col-sm-8" name="endereco" id="endereco" value="<?php
                                                                                                            echo isset($estagiario->endereco) ? $estagiario->endereco : '';
                                                                                                            ?>" />
                </div>
                <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">Dados Bancários:</label>
                    <input type="text" class="form-control col-sm-8" name="dados_bancarios" id="dados_bancarios" value="<?php
                                                                                                                        echo isset($estagiario->dados_bancarios) ? $estagiario->dados_bancarios : '';
                                                                                                                        ?>" />
                </div>
               <!-- <div class="form-group form-row">
                    <label class="  fw-bolder  col-sm-2 col-form-label text-right">Função do Estagiário:</label>
                    <input type="text" class="form-control col-sm-8" name="function" id="function" value="<?php
                                                                                                                        #echo isset($projeto->function) ? $projeto->function : '';
                                                                                                                        ?>" />
                </div>-->
                <div class="form-group form-row">
                <label class="  fw-bolder  col-sm-2 col-form-label text-right fw-bolder">Associar Projeto:</label>
                <label class="p-0 m-0 col-sm-2 col-form-label text-right">Digite os IDs dos projetos seguidos por vírgulas.</label>
                <input  type="text" class="form-control col-sm-8" name="id_project" id="id_project" value="" />
                </div>  
<!-- --> 
                 <div class="form-group form-row">
               
                <?php #class=" form-crontrol form-select form-select-sm" 
                     
                    if($nomeProjetos>0){
                        echo  '<label class="  fw-bolder  col-sm-2 col-form-label text-right fw-bolder">Projetos Associados:</label>';
                        echo '<select  class="form-select"  aria-label="multiple select example name="projetosAssoc id="projetosAssoc">';
                        foreach($nomeProjetos as $nomeProjeto){
                            echo "<hr>";
                             echo "<option disabled > ID:".$nomeProjeto->id_project. ' NOME:'.  $nomeProjeto->name. "</option>";
                        }  
                      echo '</select>'; 
                    }
                    
                    
                 ?>
                </div>
               
            </div>  
                <div class="card-footer mt-2 p-4">
                    <input type="hidden" name="id_estagiario" id="id_estagiario" value="<?php echo isset($estagiario->id_estagiario) ? $estagiario->id_estagiario : null; ?>" />
                    <button class="btn btn-success"  onclick="validarIDs(document.getElementById('id_project'), <?php echo $projeto?>)" type="submit">Salvar</button>
                    <button class="btn btn-secondary">Limpar</button>
                    <a class="btn btn-danger" href="?controllers=estagiarioController&method=listar">Cancelar</a>
                </div>
            </div>
        </form>
    <?php } ?>
</div>
<script>
// Inicializa uma variável JavaScript com os IDs dos projetos
var listaProjetos = <?php echo json_encode(array_column($projeto, 'id_project')); ?>;

function validarForm() {
    // Chama validarIDs para verificar os IDs do projeto
    if (!validarIDs(document.getElementById('id_project'), listaProjetos)) {
        return false; // Impede o envio do formulário se a validação falhar
    }
    return true; // Permite o envio do formulário se todas as validações passarem
}

function validarIDs(input, lista) {

    // Expressão regular para validar IDs (números e vírgulas)
    var regex = /^(?:[0-9]+(?:,[0-9]+)*)?$/;

    if(input.value == ""){
        return true
    }

    // Verifica se o valor do input corresponde à expressão regular
    if (!regex.test(input.value)) {
        alert("Por favor, insira ID válido.");
        return false;
    }
    
    // Verifica se há duas vírgulas seguidas
    if (input.value.includes(",,") || input.value.endsWith(",")) {
        alert("Por favor, remova vírgulas duplicadas ou vírgulas no final.");
        return false;
    }
    
    // Divide os IDs digitados pelo usuário
    var ids = input.value.split(",");
    
    // Verifica se todos o ID está na lista de projetos
    for (var i = 0; i < ids.length; i++) {
        if (!lista.includes(parseInt(ids[i]))) {
            alert("Por favor, insira apenas o ID de projetos existentes.");
            return false;
        }
    }
    
    // Limita a quantidade de IDs
    if (ids.length > lista.length) {
        alert("Por favor, insira no máximo " + 1 + " ID.");
        input.value = ids.slice(0, 1).join(",");
        return false;
    }
    
    return true;
}
</script>
