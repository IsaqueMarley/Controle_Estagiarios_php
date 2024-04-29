<h2 class="text-center">PAGAMENTOS</h2>
<hr>
<?php if(!($estagiarios )){ #and $projetos
       echo '<div class="container-fluid mt-5 text-center">
       <h1 class="text-center">Para realizar pagamentos é necessário ter estagiários e 
        projetos </h1>
       <a class="btn btn-success mt-3" href="tela.php?controllers=projetoController&method=listar">CRIAR PROJETO</a>
       <a class="btn btn-success mt-3" href="tela.php?controllers=estagiarioController&method=listar">CRIAR ESTAGIÁRIO</a>
        </div>';
}else{ 
?>
<div class="container p-0" >
  <div>
    <a id="voltar" href="index.php" class="btn btn-secondary ">Voltar</a> 
  </div>

            
    <table id="tabela" class="table table-striped m-0 p-0" style="width:100%">
        <thead>
            <tr>
                <th>ESTAGIÁRIOS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    
                
            <?php
            if ($estagiarios) {
                foreach ($estagiarios as $estagiario) {
            ?>
                    <tr  >
                        <td class="align-middle text-uppercase text-start"><?php (!isset($estagiario->nome)? NULL : print_r($estagiario->nome)); ?></td>
                        <td class="align-start text-center ">                            
                            <a  href="?controllers=anexosController&method=listar&id=<?php echo $estagiario->id_estagiario; ?>" class="btn btn-info btn-sm  p-1 m-2 px-2">ANEXOS</a>
                            <a href="?controllers=pagamentosController&method=pagar&id=<?php  echo $estagiario->id_estagiario; ?>"   class="btn btn-success btn-sm  p-1 px-3 ">PAGAR</a>

                    </tr>
                <?php
                }
            } 
                ?>
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>VER</th>
            </tr>
        </tfoot> -->
    </table>
</div>
<script>
    new DataTable('#tabela');
</script>
<script defer src="/assets/Js/pagamento.js"></script>
<script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php

}
?>