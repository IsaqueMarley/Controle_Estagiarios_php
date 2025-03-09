<?php

/**
 * classe Estagiário - baseado no modelo Active Record (Simplificado)
 */
class Estagiario
{

    private $atributos;

    public function __construct()
    {}

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
     * tornar os valores aceitos para sintaxe SQL
     * @param mixed $dados
     * @return string
     */
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'".addslashes($dados)."'";
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


    // public function save()
    // {
    // $colunas = $this->preparar($this->atributos);
    
    // if (!isset($this->id)) {
    //     $campos = implode(', ', array_keys($colunas));
    //     $valores = implode(', ', array_fill(0, count($colunas), '?')); // Cria uma string com tantos '?' quanto valores existirem

    //     $query = "INSERT INTO estagiario ({$campos}) VALUES ({$valores})";
    // } else {
    //     $definir = [];
    //     foreach ($colunas as $key => $value) {
    //         if ($key !== 'id') {
    //             $definir[] = "{$key}=?";
    //         }
    //     }
    //     $query = "UPDATE estagiario SET ".implode(', ', $definir)." WHERE id=?";
    //     $colunas['id'] = $this->id;
    // }

    // $conexao = Conexao::getInstance();
    // $stmt = $conexao->prepare($query);

    // // Faz o bind dos valores aos parâmetros da consulta preparada
    // $i = 1;
    // foreach ($colunas as $valor) {
    //     $stmt->bindParam($i++, $valor);
    // }

    // if ($stmt->execute()) {
    //     return $stmt->rowCount();
    // }

    // return false;
    // }
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        
        if (!isset($this->id_estagiario)) {
            echo var_dump($colunas);
        
               $query = "call AdicionarEstagiario(". implode(',',array_values($colunas)).",@id_estagiario);"  ;
            //$query = "INSERT INTO estagiario (".implode(', ', array_keys($colunas)).") VALUES (".implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id_estagiario') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE estagiario SET ".implode(', ', $definir)." WHERE id_estagiario='{$this->id_estagiario}';";
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
     * Retorna uma lista de estagiários
     * @return array|boolean
     */
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM estagiario;");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Estagiario::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    /**
     * Retornas apenas os nomes e ids dos estagiarios
     */
    public static function id_name()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT id_estagiario,nome FROM estagiario;");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Estagiario::class)) {
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
        $stmt    = $conexao->prepare("SELECT * FROM estagiario WHERE id_estagiario='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('estagiario');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }

     /**
     * Destruir um recurso
     * @param int $id
     * @return boolean
     */
    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM estagiario WHERE id_estagiario='{$id}';")) {
            return true;
        }
        return false;
    }

    /**
     * Retornar o ultimo dado inserido
     */
    public static function ultimo()
    {
        $query = "SELECT * FROM estagiario ORDER BY id_estagiario DESC LIMIT 1";
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare($query);
        if($stmt->execute()){
            if($stmt->rowCount()>0){
                $resultado = $stmt->fetchObject('estagiario');
                if($resultado){
                    return $resultado;
                }
            }
        }
        return false;
    }

    /**
     * Método para teste de API
     *  
     * */
    public static function testeAPI()
    {
        $query = "SELECT *FROM estagiario";
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare($query);
        if($stmt->execute()){
            if($stmt->rowcount()>0){
                $res = $stmt->fetchObject("estagiario");
                if($res){
                    return $res;
                }
            }
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