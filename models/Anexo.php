<?php

/**
 * classe Anexo - baseado no modelo Active Record (Simplificado)
 */
class Anexo
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
        
        if (!isset($this->id_anexo)) {
           
            $query = "INSERT INTO anexo (".implode(', ', array_keys($colunas)).") VALUES (".implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id_anexo') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE anexo SET ".implode(', ', $definir)." WHERE id_anexo='{$this->id_anexo}';";
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
     * Retorna uma lista de anexos
     * @return array|boolean
     */
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM anexo");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Anexo::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    
    public static function find_all($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT p.file
        FROM anexo p
        INNER JOIN pagamentos pe ON (p.id_pagamentos = pe.id_pagamentos)
        
        WHERE pe.id_estagiario = '{$id}';");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Anexo::class)) {
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
        $stmt    = $conexao->prepare("SELECT * FROM anexo WHERE id_anexo='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('anexo');
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
    public static function files($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT p.data,pe.file
        FROM pagamentos p
        INNER JOIN anexo pe ON (p.id_pagamentos = pe.id_pagamentos)
        
        WHERE p.id_estagiario = '{$id}';");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Anexo::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
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
        if ($conexao->exec("DELETE FROM anexo WHERE id_anexo='{$id}';")) {
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
        $count   = $conexao->exec("SELECT count(*) FROM anexo;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }
}