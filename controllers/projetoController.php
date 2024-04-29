<?php

class ProjetoController extends Controller
{
    /**
     * listar os projetos
     */
    public function listar()
    {
        $projetos = Projeto::all();

        return $this->view("views/projeto/gradeProjeto", ['projetos' => $projetos]);
    }
    
    /**
     * Redirecionar para a lista de projetos
     */
    public function redirecionar()
    {
        echo '<script>window.location.href="tela.php?controllers=projetoController&method=listar"</script>';
        exit;

    }

    /**
     * Mostrar formulário para criar um projeto
     */
    public function criar()
    {
        $projetos    = Projeto::all();
        $estagiarios = Estagiario::id_name();

        return $this->viewmulti("views/projeto/formProjeto", [['projetos' => $projetos], ['estagiarios' => $estagiarios]]);
    }

    /**
     * Mostrar formulário para editar projeto
     */
    public function editar($dados)
    {

        $id = (int) $dados['id'];
        $projetos = Projeto::find($id);
        return $this->view("views/projeto/formProjeto", ['projetos' => $projetos]);
    }

    /**
     * Finalizar o projeto
     */
    public function finalizar($dados)
    {
        
        $id                  = (int) $dados['id'];
        $projetos            = Projeto::find($id);
        $this->view("views/projeto/finalizarProjeto",['projetos'=>$projetos]);
    }




    /**
     * Salvar o projeto
     */
    public function salvar()
    {
        $projeto                = new Projeto;
        $projeto->name          = $this->request->nome;
        $projeto->description   = $this->request->description;
        $projeto->start_date    = $this->request->start_date;
        $projeto->end_date      = $this->request->end_date;
        $projeto->company       = $this->request->company;
        $projeto->status_       = $this->request->status_;
        if ($projeto->save()) {
            return $this->redirecionar();
        }
    }

    /**
     * Atualizar os dados de um projeto
     */
    public function atualizar($dados)
    {
        $id                     = (int) $dados['id'];
        $projeto                = Projeto::find($id);
        $projeto->id_project    = $id;
        $projeto->name          = $this->request->nome;
        $projeto->description   = $this->request->description;
        $projeto->start_date    = $this->request->start_date;
        $projeto->end_date      = $this->request->end_date;
        $projeto->company       = $this->request->company;
        $projeto->status_       = $this->request->status_;
        $projeto->save();

        return $this->redirecionar();
    }


    /**
     * Apagar projeto
     */
    public function excluir($dados)
    {
        $id       = (int) $dados['id'];
        $contrato = Projeto::destroy($id);
        return $this->redirecionar();
    }
}
