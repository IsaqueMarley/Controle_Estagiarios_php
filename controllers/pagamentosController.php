<?php

class PagamentosController extends Controller
{
    /**
     * listar os pagamentos
     */
    public function listar()
    {
        $estagiarios = Estagiario::all();
        return $this->view("views/pagamentos/gradePagamentos", ['estagiarios'=>$estagiarios]);
    }
    
    /**
     * Redirecionar para a lista de pagamentos
     */
    public function redirecionar()
    {
        echo '<script>window.location.href="tela.php?controllers=pagamentosController&method=listar"</script>';
        exit;

    }

    /**
     * Mostrar formulário para criar um pagamento
     */
    public function criar()
    {
        $pagamentos  = Pagamentos::all();
        $estagiarios = Estagiario::id_name();
        $projetos    = Projeto::all();

        return $this->viewmulti("views/pagamento/formPagamento", [['pagamentos' => $pagamentos], ['estagiarios' => $estagiarios],[ 'projetos' => $projetos]]);
    }

    /**
     * Mostrar formulário para editar pagamento
     */
    public function editar($dados)
    {

        $id = (int) $dados['id'];
        $pagamentos = Pagamentos::find($id);
        return $this->view("views/pagamento/formProjeto", ['pagamentos' => $pagamentos]);
    }


    /**
     * Mostrar formulário de pagamento
     */
    public function pagar($dados)
    {
        $id             = (int) $dados['id'];
        $estagiario     = Estagiario::find($id);
        $projeto        = ProjetosEstagiario::id_projects($id);
        $id_estagiarios = ProjetosEstagiario::trazIds($id);//remover 
        $pagamentos     = Pagamentos::find_estagiario($id);
        
        return $this->viewmulti("views/pagamentos/formPagamento", [['estagiario' => $estagiario],['projeto'=>$projeto],['id_estagiarios'=>$id_estagiarios],['pagamentos'=>$pagamentos]]);

    }

    /**
     * Salvar o pagamento
     */
    public function salvar()
    {
        $pagamento = new Pagamentos;
        $pagamento->id_estagiario      = $this->request->id_estagiario;
        $pagamento->data               = $this->request->data;
        $pagamento->valor_pago         = $this->request->valor_pago;
        $pagamento->quantity           = $this->request->quantity;
        $pagamento->description        = $this->request->description;
        $pagamento->id_project_manager = $this->request->id_project_manager;
        $pagamento->created_at         = $this->request->created_at;
        $pagamento->updated_at         = $this->request->updated_at;
        $pagamento->enabled            = 1;
        if($pagamento->save()){
            
            $anexo          = new Anexo; 
            $dado_pagamento = Pagamentos::ultimo();
            //tratamento dos arquivos
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
                $diretorio_de_upload = 'assets/uploads/';
                if (!file_exists($diretorio_de_upload)) {
                    mkdir($diretorio_de_upload, 0777, true); // Cria o diretório se não existir
                }
            
                // Iterar sobre os arquivos enviados
                foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['files']['name'][$key];
                    $file_tmp = $_FILES['files']['tmp_name'][$key];
                    $file_error = $_FILES['files']['error'][$key];
            
                    // Verificar se o upload foi bem-sucedido
                    if ($file_error === UPLOAD_ERR_OK) {
                        // Mover o arquivo para o diretório de upload
                        $destino = $diretorio_de_upload . $file_name;
                        move_uploaded_file($file_tmp, $destino);
                        
                        //adicionando ao objeto anexo os dados de pagamento
                        $anexo->file = $destino; 
                        $anexo->description   = $this->request->description;
                        $anexo->id_pagamentos= $dado_pagamento->id_pagamentos;
                        

                    } 
                }
            }
             
            $anexo->id_pagamentos = $dado_pagamento->id_pagamentos;
            $anexo->description   = $this->request->description;
            
            $anexo->save();
            return $this->redirecionar();
        }else{
            $dado_pagamento = Pagamentos::ultimo();
            $erro  =Pagamentos::destroy($dado_pagamento->id_pagamentos);
            echo '<script>window.alert("O Pagamento não foi realizado, por favor contate o desenvolvedor.")</script>';
            return $this->redirecionar();
        } 
        
    }
    

}
