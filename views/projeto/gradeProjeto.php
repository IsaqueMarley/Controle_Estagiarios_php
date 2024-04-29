<h2 class="text-center">PROJETOS</h2>
<hr>
<div class="container p-0" >

  <div >
    <div>
      <a id="voltar" href="index.php" class="btn btn-secondary position-absolute ">Voltar</a> 
    </div>
    <div class="text-end">
      <a id="novo" href="?controllers=projetoController&method=criar" class="btn btn-success btn-lg  ">Novo</a>
    </div>
  </div> 
            
    <table id="tabela" class="table table-striped m-0 p-0" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" >ID</th>
                <th class="text-center">NOME</th>
                <th class="text-center">Data Fim</th>
                <th class="text-center">VER</th>
            </tr>
        </thead>
        <tbody>
    
                
            <?php
            if ($projetos) {
                foreach ($projetos as $projeto) {
            ?>
                    <tr >
                        <td  class="align-middle text-center"><?php (!isset($projeto->id_project)? NULL : print_r($projeto->id_project)); ?></td>
                        <td  class="align-middle text-center"><?php (!isset($projeto->name)? NULL : print_r($projeto->name)); ?></td>
                        <td  class="align-middle text-center"><?php echo $projeto->end_date; ?></td>
                        <td class=""  class="align-middle text-center">
                            <a href="?controllers=projetoController&method=editar&id=<?php echo $projeto->id_project; ?>" class="btn btn-primary btn-sm  px-3"> Ver Mais</a>
                            
                            <a href="?controllers=projetoController&method=finalizar&id=<?php echo $projeto->id_project; ?>" class="btn btn-danger btn-sm mt-4 px-3 ">Finalizar</a>
                        </td>
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
<script defer src="/assets/Js/projeto.js"></script>
<script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
