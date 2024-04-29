
<!-- editar pagamentos - método futuro
 "method=atualizar&id={$estagiario->id_estagiario}"
 -->
<div>
  <a id="voltar" href="?controllers=pagamentosController&method=listar" class="btn btn-secondary ">Voltar</a> 
</div>
<?php 
    if(!($id_estagiarios)){
        echo '<div class="container-fluid mt-5 text-center">
        <h1 class="text-center"> :( Para realizar pagamentos você deve associar esse estagiário a um projeto. Se acredita que há algum erro contate o desenvolvedor. </h1> 
    <a class="btn btn-success mt-3" href="tela.php?controllers=projetoController&method=listar">CRIAR PROJETO</a>
    <a class="btn btn-success mt-3" href="tela.php?controllers=estagiarioController&method=listar">ASSOCIAR</a>
    </div>';
    }else {
?>
  


<div class="container" >
  

    <form action="?controllers=pagamentosController&method=salvar" method="post" onsubmit="return validarForm()" enctype="multipart/form-data"  >
        <div class="card" style="top:40px; " >
            <div class="card-header  text-center  bg-info">
                <span class="card-title fw-bolder">REALIZAR PAGAMENTO</span>
            </div>
            <div class="card-body">
            </div>
            <div class="form-group form-row mt-1 ">

                <label class=" fw-bolder col-sm-2 col-form-label text-right fw-bolder">Nome:</label>
                <p class="text-uppercase"><?php echo isset($estagiario->nome) ? $estagiario->nome : null; ?></p>

                <input type="hidden" class="form-control col-sm-8" name="nome" id="validationDefault01" value="<?php
                 echo isset($estagiario->nome) ? $estagiario->nome : null;?>" required />

            </div>

            <div class="form-group form-row">
                <label class="  fw-bolder  col-sm-2 col-form-label text-right">Valor da Bolsa + Auxílio R$:</label>
                 
                <p><?php echo (isset($estagiario->valor_bolsa) and isset($estagiario->auxilio)) ? $estagiario->valor_bolsa + $estagiario->auxilio : 0.0; ?> </p>
                    
                <input type="hidden" class="form-control col-sm-8" onchange="setTwoNumberDecimal" min="0" max="" step="0.01" name="valor_pago" id="valor_pago" value="<?php
                 echo   $estagiario->valor_bolsa + $estagiario->auxilio; ?>" required />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Data do Pagamento:</label>
                <p><?php echo (new \DateTime())->format( 'd-m-Y' ); ?></p>
                <input type="hidden" class="form-control col-sm-8" name="data" id="data" value="<?php echo (new \DateTime())->format( 'Y-m-d' );?>" />
            </div>  
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Primeiro Pagamento em:</label>
                <p><?php echo isset($pagamentos->created_at)? $pagamentos->created_at : "Não houve." ?></p>
                <input type="hidden" class="form-control col-sm-8" name="created_at" id="created_at" value="<?php  echo isset($pagamentos->created_at)? $pagamentos->created_at : "";?>" />
            </div> 
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Último Pagamento em:</label>
                <p><?php echo isset($pagamentos->updated_at)? $pagamentos->updated_at : "Não há." ?></p>
                <input type="hidden" class="form-control col-sm-8" name="updated_at" id="updated_at" value="<?php  echo isset($pagamentos->updated_at)? $pagamentos->updated_at : "";?>" />
            </div> 
            <div class="d-none form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Quantidade:</label>
               <input  type="hidden" class="form-control col-sm-8" name="quantity" id="quantity"
                 value=" <?php isset($pagamentos->quantity) ? print_r($pagamentos->quantity  ): "0" ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">ID do id_project_manager:</label>
               <input required type="text" class="form-control col-sm-8" name="id_project_manager" id="id_project_manager"
                 value=" <?php isset($pagamentos->id_project_manager) ?  $pagamentos->id_project_manager : "" ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Descrição:</label>
                <input  type="text" class="form-control col-sm-8" name="description" id="description"
                 value="<?php isset($pagamentos->description) ? $pagamentos->description: " " ?>"required />
            </div>  
            <div class="form-group form-row">
                <label class="  fw-bolder  col-sm-2 col-form-label text-right fw-bolder">Projeto  </label>
                <label class="p-0 m-0 col-sm-2 col-form-label text-right">(Digite o ID do projeto):</label>
                <input required  type="text" class="form-control col-sm-8" name="id_project" id="id_project" value="" />
                </div>  
            <div class="form-group form-row">
                <label for="" class="col-sm-2 col-form-label text-right fw-bolder">Arquivos</label>
                <input type="file" multiple="multiple" name="files[]" class="form-control" id="inputGroupFile01">
            </div>
            <div class="card-footer">
                <input type="hidden" name="id_estagiario" id="id_estagiario" value="<?php echo isset($estagiario->id_estagiario) ? $estagiario->id_estagiario : null; ?>" />
                <button class="btn btn-success" onclick="validarIDs(document.getElementById('id_project'), <?php echo $projeto?>)" type="submit">Salvar </button>
                <a class="btn btn-danger" href="?controllers=pagamentosController&method=listar">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<?php }?>

<script>
// Inicializa uma variável JavaScript com os IDs dos projetos
var listaProjetos = <?php echo json_encode(array_column($projeto, 'id_project')); ?>;
console.log(listaProjetos)
function validarForm() {
    // Chama validarIDs para verificar os IDs do projeto
    if (!validarIDs(document.getElementById('id_project'), listaProjetos)) {
        return false; // Impede o envio do formulário se a validação falhar
    }
    return true; // Permite o envio do formulário se todas as validações passarem
}

function validarIDs(input, lista) {
    // Expressão regular para validar IDs (números e vírgulas)
    var regex = /^[0-9]+(?:,[0-9]+)*$/;
    
    // Verifica se o valor do input corresponde à expressão regular
    if (!regex.test(input.value)) {
        alert("Por favor, insira um ID válido.");
        return false;
    }
    
    // Verifica se há duas vírgulas seguidas
    if (input.value.includes(",,") || input.value.endsWith(",")) {
        alert("Por favor, remova as vírgulas");
        return false;
    }
    
    // Divide os IDs digitados pelo usuário
    var ids = input.value.split(",");
    
    // Verifica se todos os IDs estão na lista de projetos
    for (var i = 0; i < ids.length; i++) {
        if (!lista.includes(parseInt(ids[i]))) {
            alert("O estagiario NÃO está cadastrado nesse projeto, por favor digite ID correto.");
            return false;
        }
    }
    
    // Limita a quantidade de IDs
    if (ids.length > lista.length) {
        alert("Por favor, insira no máximo " +1 + " ID.");
        input.value = ids.slice(0, lista.length).join(",");
        return false;
    }
    
    return true;
}
</script>
