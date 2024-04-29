<?php

class ProjetosEstagiarioController extends Controller
{
  
  
    /**
     * listar estagiários
     */
    public function listar()
    {
        $estagiarios = ProjetosEstagiario::all();
        return $this->view("views/projetoEstagiario/gradeProjetosEstagiario",['estagiarios'=>$estagiarios]);

    }
    
    /**
     * Mostrar formulário para cadastrar estagiário
     */
    public function criar()
    {
        $projeto = ProjetosEstagiario::all();
        return $this->view("views/projetosEstagiario/",['projeto'=>$projeto]);
    }

    /**
     * Redirecionar para grade de listagem de estagiarios
     */
    public function redirecionar()
    {
      $rota ='?controllers=estagiarioController&method=listar' ;
      echo "<script>window.location.href='$rota'</script>";
      exit;
    }



    /**
     * 
     */
    public function salvar()
    {
        $projetoEstagiario                  = new ProjetosEstagiario;
        $projetoEstagiario->id_project      = $this->request->id_project;
        $projetoEstagiario->valor_bolsa     = $this->request->valor_bolsa;
        $projetoEstagiario->id_estagiario   = $this->request->id_estagiario;
        $projetoEstagiario->function        = $this->request->function;
        $projetoEstagiario->start_date      = $this->request->start_date;
        $projetoEstagiario->end_date        = $this->request->end_date;      
        if($projetoEstagiario->save()){
            return $this->redirecionar(); #redirecionar("?controllers=estagiarioController&method=listar");
        }
    }
        
    /**
     * Mostrar formulário para editar um contrato
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $estagiario = Estagiario::find($id);

        return $this->view('views/estagiario/formEstagiario', ['estagiario' => $estagiario]);
    } 
    
    
    /**
     * Atualizar o estagiario conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                          = (int) $dados['id'];
        $estagiario                  = Estagiario::find($id);
        $estagiario->nome            = $this->request->nome;
        $estagiario->valor_bolsa     = $this->request->valor_bolsa;
        $estagiario->auxilio         = $this->request->auxilio;
        $estagiario->email           = $this->request->email;
        $estagiario->user_name       = $this->request->user_name;
        $estagiario->password        = $this->request->password;
        $estagiario->endereco        = $this->request->endereco;
        $estagiario->dados_bancarios = $this->request->dados_bancarios;
        $estagiario->save();

        return $this->listar(); #redirect("?controllers=estagiarioController&method=listar");
    }

    
    /**
     * Apagar um estagiario conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $estagiario = Estagiario::destroy($id);
        return $this->listar();
    }

}
