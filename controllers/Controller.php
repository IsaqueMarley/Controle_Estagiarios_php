<?php

/**
 * Classe Controller - classe de controle principal
 */
class Controller
{
    public $request;

    public function __construct()
    {
        $this->request = new Request; 
    }
    public function view($arquivo, $array = null)
    {
        if (!is_null($array)) {
            foreach ($array as $var => $value) {
                ${$var} = $value;
            }
        }
        ob_start();
        include "{$arquivo}.php";
        ob_flush();
    }

    public function viewmulti($arquivo, $array = null)
    {
        if (!is_null($array)) {
            foreach ($array as $arraymulti) {
                foreach ($arraymulti as $var =>$value){
                    ${$var} = $value;
                }               
            }
        }
        ob_start();
        include "{$arquivo}.php";
        ob_flush();
    }
}