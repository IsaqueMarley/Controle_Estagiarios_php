<h2 class="text-center">PAGAMENTOS</h2>
<hr>

<div class="container p-0" >
            
    <table id="tabela" class="table table-striped m-0 p-0" style="width:100%">
        <thead>
            <tr>
                <th>NOME</th>
                <th>valor PAGO</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    
                
            <?php
            if ($projetos) {
                foreach ($projetos as $projeto) {
            ?>
                    <tr  >
                        <td style="text-align: left;"><?php (!isset($projeto->nome)? NULL : print_r($projeto->nome)); ?></td>
                        <td class="">                            
                            <a href="?controllers=pagamentosController&method=anexos&id=<?php echo $projeto->id_project; ?>" class="btn btn-info d-flex  text-center">ANEXOS</a>
                            <a href="?controllers=pagamentosController&method=pagar&id=<?php  echo $projeto->id_project; ?>"   class="btn btn-success d-flex">PAGAR</a>

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
