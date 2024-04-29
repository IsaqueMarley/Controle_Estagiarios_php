<?php

class EstagiarioController extends Controller
{
    /**
     * listar estagiários
     */
    public function listar()
    {
        $estagiarios = Estagiario::all();
        return $this->view("views/estagiario/gradeEstagiario", ['estagiarios' => $estagiarios]);
    }

    /**
     * Mostrar formulário para cadastrar estagiário
     */
    public function criar()
    {
        $projeto = Projeto::all();
        $nomeProjetos       = ProjetosEstagiario::Projects(0);
        return $this->viewmulti("views/estagiario/formEstagiario", [['projeto' => $projeto], ['nomeProjetos' => $nomeProjetos]]);
    }

    /**
     * Redirecionar para grade de listagem de estagiarios
     */
    public function redirecionar($rota)
    {
        echo "<script>window.location.href= '$rota'</script>";
        exit;
    }



    /**
     * Salvar novo estagiário
     */
    public function salvar()
    {
        //dados do estagiario
        $estagiario                  = new Estagiario;
        $estagiario->nome            = $this->request->nome;
        $estagiario->valor_bolsa     = $this->request->valor_bolsa;
        $estagiario->auxilio         = $this->request->auxilio;
        $estagiario->email           = $this->request->email;
        $estagiario->user_name       = $this->request->user_name;
        $estagiario->password        = $this->request->password;
        $estagiario->endereco        = $this->request->endereco;
        $estagiario->dados_bancarios = $this->request->dados_bancarios;
        $idsProjetos                 = $this->request->id_project;

        if ($estagiario->save()) {


            $dado_estagiario   = Estagiario::ultimo();
            $projetoEstagiario = new ProjetosEstagiario;
            $atualizar_projeto = new Projeto;
         
            foreach (explode(',', $idsProjetos) as $chave => $idProjeto) {

                //Faz a busca pelo projeto e se existir será criado um registro associando o estagiário ao projeto
                $projeto                              = Projeto::find($idProjeto);
                if ($projeto) {

                    $projetoEstagiario->id_project    = $idProjeto;
                    $projetoEstagiario->id_estagiario = $dado_estagiario->id_estagiario;
                    $projetoEstagiario->function      = " ";
                    $projetoEstagiario->start_date    = $projeto->start_date;
                    $projetoEstagiario->end_date      = $projeto->end_date;
                    
                    //Atualiza o projeto associando o ID do estagiário a ele
                    $atualizar_projeto->id_project    = $idProjeto;
                    $atualizar_projeto->id_estagiario = $dado_estagiario->id_estagiario;

                    $atualizar_projeto->save();
                    $projetoEstagiario->save();
                }
            }
            $this->redirecionar('?controllers=estagiarioController&method=listar');
        }
        $this->excluir($estagiario);
        echo
        '<div class="container-fluid mt-5 text-center text-warning">
                    <h1 class="text-center">Houve um Erro ao Cadastrar Estagiário
                    Contate URGENTEMENTE o Desenvolvedor!.</h1>
                    </div>';
    }

  

    /**
     * Mostrar formulário para editar um contrato
     */
    public function editar($dados)
    {
        $id                 = (int) $dados['id'];
        $estagiario         = Estagiario::find($id);
        $projeto            = Projeto::all();
        $nomeProjetos       = ProjetosEstagiario::Projects($id);

        return $this->viewmulti('views/estagiario/formEstagiario', [['estagiario' => $estagiario], ['projeto' => $projeto], ['nomeProjetos' => $nomeProjetos]]);
    }


    /**
     * Atualizar o estagiario conforme dados submetidos
     */
    public function atualizar($dados)
    {
        //dados do estagiario
        $id                          = (int) $dados['id'];
        $estagiario                  = Estagiario::find($id);
        $estagiario->id_estagiario   = $id;
        $estagiario->nome            = $this->request->nome;
        $estagiario->valor_bolsa     = $this->request->valor_bolsa;
        $estagiario->auxilio         = $this->request->auxilio;
        $estagiario->email           = $this->request->email;
        $estagiario->user_name       = $this->request->user_name;
        $estagiario->password        = $this->request->password;
        $estagiario->endereco        = $this->request->endereco;
        $estagiario->dados_bancarios = $this->request->dados_bancarios;
        $idProjeto                   = $this->request->id_project;


        $estagiario->save();



        if ($idProjeto != "") {
            $checar = Projeto::busca($id, $idProjeto);

            if (!$checar) {
                #$dado_estagiario = Estagiario::ultimo(); 
                $dado_do_projeto = Projeto::find($idProjeto);

                $projetoEstagiario                = new ProjetosEstagiario;
                $projetoEstagiario->id_project    = $idProjeto;
                $projetoEstagiario->id_estagiario = $id;
                $projetoEstagiario->function      = " ";
                $projetoEstagiario->start_date    = $dado_do_projeto->start_date;
                $projetoEstagiario->end_date      = $dado_do_projeto->end_date;

                #$atualizar_projeto->id_estagiario = $dado_estagiario->id_estagiario;

                #$atualizar_projeto->save();
                $projetoEstagiario->save();
            } else {
                echo '<script>window.alert("Os dados foram atualizados, porém o Estagiário já estava associado ao projeto!")</script>';
                return $this->redirecionar('?controllers=estagiarioController&method=listar');
            }
        }
        return $this->redirecionar('?controllers=estagiarioController&method=listar');
    }




    /**
     * Apagar um estagiario conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $projetosEstagiarios = ProjetosEstagiario::destroy($id);
        $estagiario = Estagiario::destroy($id);
        return $this->redirecionar('?controllers=estagiarioController&method=listar');
    }
}
