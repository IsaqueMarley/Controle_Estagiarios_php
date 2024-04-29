<?php

class Conexao
{
    private static $conexao;

    private function __construct()
    {}

    public static function getInstance()
    {                                 
        if (is_null(self::$conexao)) { 
            self::$conexao = new \PDO('mysql:host=127.0.0.1;port=3306;dbname=banco1', 'root', '');
            self::$conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$conexao->exec('set names utf8');
        }
        return self::$conexao;
    }
}