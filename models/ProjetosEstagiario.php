<?php

/**
 * classe projetoEstagiário - 
 */
class ProjetosEstagiario
{

    private $atributos;

    public function __construct()
    {
    }

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }
    /**
     * Encontra os IDs dos projetos que estão associado ao id do estagiário
     */
    
     public static function id_projects($id_estagiario)
     {
     
         $conexao = Conexao::getInstance();
         $stmt    = $conexao->prepare("SELECT p.id_project
         FROM projeto p
         INNER JOIN projetosestagiario pe ON p.id_project = pe.id_project
         WHERE pe.id_estagiario = {$id_estagiario};
         ");
         $result  = array();
         if ($stmt->execute()) {
             while ($rs = $stmt->fetchObject(ProjetosEstagiario::class)) {
                 $result[] = $rs;
             }
         }
         if (count($result) > 0) {
             return $result;
         }
         return false;
         
         
     }
    /**
     * Encontra os projetos assiciados ao estagiário com id_estagiário
     */
    public static function Projects($id_estagiario)
    {
    
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT p.name,p.id_project
        FROM projeto p
        INNER JOIN projetosestagiario pe ON p.id_project = pe.id_project
        WHERE pe.id_estagiario = {$id_estagiario};
        ");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(ProjetosEstagiario::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
        
        
    }

    /**
     * tornar os valores aceitos para sintaxe SQL
     * @param mixed $dados
     * @return string
     */
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'" . addslashes($dados) . "'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }

    /**
     * Verifica se dados são próprios para ser salvos
     * @param array $dados
     * @return array
     */
    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }

    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        
        if (!isset($this->id_project_estagiario)) {

            $query = "INSERT INTO projetosestagiario (" . implode(', ', array_keys($colunas)) . ") VALUES (" . implode(', ', array_values($colunas)) . ");";
            echo $query;
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id_project_estagiario') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE projetosestagiario SET " . implode(', ', $definir) . " WHERE id_project_estagiario='{$this->id_project_estagiario}';";
        }
        if ($conexao = Conexao::getInstance()) {
            #if($this->check(array_values($colunas))){
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
            # }

        }
        return false;
    }

    /**
     * Retorna uma lista de projetosEstagiarios
     * @return array|boolean
     */
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM projetosestagiario;");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(ProjetosEstagiario::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }


    /**
     * Encontra um recurso pelo id
     */
    public static function find($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM projetosestagiario WHERE id_project_estagiario='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('projetosestagiario');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }
    
    /**
     * Encontra o projeto e retorna os ids_estagiarios dos associados ele
     */
    public static function trazIds($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT p.id_project
        FROM projeto p
        INNER JOIN projetosestagiario pe ON (p.id_project = pe.id_project)
        AND p.status_ = 0
        WHERE pe.id_estagiario = '{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('projetosestagiario');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }
    /**
     * Encontra um recurso pelo id do projeto e pelo id do estagiario
     */
    public static function findProject($id, $idEstagiario)
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM projetosestagiario WHERE id_estagiario = :idEstagiario AND id_project = :id");
        $stmt->bindParam(':idEstagiario', $idEstagiario, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return false;
        }
        return true;
    }
    


    /**
     * Destruir um recurso
     * @param int $id
     * @return boolean
     */
    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM projetosestagiario WHERE id_estagiario='{$id}';")) {
            return true;
        }
        return false;
    }

    /**
     * Retornar o número de registros
     * @return int|boolean
     */
    public static function count()
    {
        $conexao = Conexao::getInstance();
        $count   = $conexao->exec("SELECT count(*) FROM estagiario;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }
}
