<h2 class="text-center">ANEXOS</h2>
<hr>

<div class="container p-0" > 
  <div>
    <a id="voltar" href="?controllers=pagamentosController&method=listar" class="btn btn-secondary ">Voltar</a> 
  </div>
    <table id="tabela" class="table table-striped m-0 p-0" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">DATA</th>
                <th class="text-center" >ARQUIVOS</th>
            </tr>
        </thead>
        <tbody>

                
            <?php
            if ($files) {
                foreach ($files as $file) {
                    $ancora = '/ZZ/'.$file->file;
                    
            ?>
                    <tr >
                        <td style="text-align: center;"><?php echo $file->data;?></td>
                        <td >
                        <a class="" target="_blank" href="<?php print_r($ancora);?>"> <?php echo $file->file;?></a>
                        </td>
                        
                    </tr>
                <?php
                }
            } 
                ?>
        </tbody>
    </table>
</div>

