<?php
namespace src\Model;

class Contato{

    private $id;
    private $email_contato;
    private $telefone_contato;
    
    public function __construct($id,$email_contato,$telefone_contato){
        $this->id=$id;
        $this->email_contato=$email_contato;
        $this->telefone_contato=$telefone_contato;

    }

    
}

?>