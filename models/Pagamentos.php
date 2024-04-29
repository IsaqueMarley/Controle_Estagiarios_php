<?php

/**
 * classe Pagamentos - baseado no modelo Active Record (Simplificado)
 */
class Pagamentos
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
    

    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        #print_r($colunas);
        if (!isset($this->id_pagamentos)) {
           
            $query = "INSERT INTO pagamentos (".implode(', ', array_keys($colunas)).") VALUES (".implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id_pagamentos') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE pagamentos SET ".implode(', ', $definir)." WHERE id_pagamentos='{$this->id_pagamentos}';";
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
     * Retorna uma lista de pagamentos
     * @return array|boolean
     */
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM pagamentos;");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Projeto::class)) {
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
        $stmt    = $conexao->prepare("SELECT * FROM pagamentos WHERE id_pagamentos='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('pagamentos');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }
     /**
     * Encontra um recurso pelo id
     */
    public static function find_estagiario($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM pagamentos WHERE id_estagiario='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('pagamentos');
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
        if ($conexao->exec("DELETE FROM pagamentos WHERE id_pagamentos='{$id}';")) {
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
        $count   = $conexao->exec("SELECT count(*) FROM pagamentos;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }
        /**
     * Retornar o ultimo dado inserido
     */
    public static function ultimo()
    {
        $query = "SELECT * FROM pagamentos ORDER BY id_pagamentos DESC LIMIT 1";
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare($query);
        if($stmt->execute()){
            if($stmt->rowCount()>0){
                $resultado = $stmt->fetchObject('pagamentos');
                if($resultado){
                    return $resultado;
                }
            }
        }
        return false;
    }
}