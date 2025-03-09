

<h2 class="text-center">ESTAGIÁRIOS</h2>
<hr>
<div class="container p-0" >
    <div >
      <div>
        <a id="voltar" href="index.php" class="btn btn-secondary position-absolute ">Voltar</a> 
      </div>
      <div class="text-end">
        <a id="novo" href="?controllers=estagiarioController&method=criar" class="btn btn-success btn-lg  ">Novo</a>
      </div>
    </div> 
  
    <table id="tabela" class="table table-striped" style="width:100%">
        <thead> 
            <tr>
                <th class="text-center" >NOM1E</th>
                <th class="text-center">BOLSA</th>
                <th class="text-center">AUXÍLIO</th>
                <th class="text-center">VER</th>
            </tr>
        </thead>
        <tbody>
                
            <?php
            if ($estagiarios) {
                foreach ($estagiarios as $estagiario) {
            ?>
                    <tr >
                        <td class="text-uppercase" style="text-align: center;"><?php (!isset($estagiario->nome)? NULL : print_r($estagiario->nome)); ?></td>
                        <td class="align-middle text-center" style="text-align: center;"><?php echo $estagiario->valor_bolsa; ?></td>
                        <td class="align-middle text-center" ><?php echo $estagiario->auxilio; ?></td>
                        <td  class="align-middle" >
                            <a href="?controllers=estagiarioController&method=editar&id=<?php echo $estagiario->id_estagiario; ?>" class="btn btn-primary btn-sm  p-2">Ver Mais</a>
                            <a href="?controllers=estagiarioController&method=excluir&id=<?php echo $estagiario->id_estagiario; ?>" class="btn btn-danger btn-sm mt-4 px-3 ">Excluir</a>
                        </td>
                    </tr>
                <?php
                }
            } 
                ?>
               
        </tbody>
        <tfoot>
            <tr>
                <th>NOME</th>
                <th>BOLSA</th>
                <th>AUXÍLIO</th>
                <th>VER</th>
            </tr>
        </tfoot>
    </table>
</div>
<script defer src="/assets/Js/estagiario.js"></script>
<script defer ="https://code.jquery.com/jquery-3.6.0.min.js"></script>
