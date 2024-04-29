<?php

class AnexosController extends Controller
{
    public function listar()
    {
        $id      = $this->request->id;
       # $anexos  = Anexo::find_all($id);
        $files    = Anexo::files($id);

        return $this->view("views/pagamentos/gradeAnexos",['files'=>$files]);
        
    }
}