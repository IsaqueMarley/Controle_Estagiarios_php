

<div class="container" >
  <div>
    <a id="voltar" href="?controllers=projetoController&method=listar" class="btn btn-secondary ">Voltar</a> 
  </div>

    <form action="?controllers=projetoController&<?php echo isset($projetos->id_project) ? "method=atualizar&id={$projetos->id_project}" :""; ?>" method="post" >
        <div class="card" style="top:40px; " >
            <div class="card-header  text-center  bg-info">
                <span class="card-title fw-bolder">Finalizar Este Projeto ?</span>
            </div>
            <div class="card-body">
            </div>
            <div class="form-group form-row">
                <label class="  fw-bolder  col-sm-2 col-form-label  fw-bolder">Nome do Projeto:</label>
                <input type="text" class="form-control col-sm-8" name="nome" id="nome" value="<?php
                echo isset($projetos->name) ? $projetos->name : null;
                ?>" />
            </div>  
            <div class="form-group form-row">
                <label class="  fw-bolder  col-sm-2 col-form-label text-right fw-bolder">Descrição:</label>
                <input type="text" class="form-control col-sm-8" name="description" id="description" value="<?php
                echo isset($projetos->description) ? $projetos->description : null;
                ?>" />
            </div> 
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Data de Início:</label>
                <input type="date" class="form-control col-sm-8" name="start_date" id="start_date" value="<?php
                echo isset($projetos->start_date) ? $projetos->start_date: null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Data de Finalização:</label>
                <input type="date" class="form-control col-sm-8" name="end_date" id="end_date" value="<?php
                echo isset($projetos->end_date) ? (new \DateTime())->format( 'Y-m-d' ): null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right fw-bolder">Empresa: </label>
                <input type="text" class="form-control col-sm-8" name="company" id="company" value="<?php
                echo isset($projetos->company) ? $projetos->company: null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <input type="hidden" class="form-control col-sm-8" name="status_" id="status_" value="1" />
            </div>

            <div class="card-footer">
                <input type="hidden" name="id_project" id="id_project" value="<?php echo isset($projetos->id_project) ? $projetos->id_project : null; ?>" />
                <button class="btn btn-success" type="submit">Finalizar</button>
                <a class="btn btn-danger" href="?controllers=projetoController&method=listar">Cancelar</a>
            </div>
        </div>
    </form>
</div>