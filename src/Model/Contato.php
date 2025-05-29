<?php
namespace src\Model;

class Contato{

    private $id;
    private $email_contato;
    private $telefone_contato;
    
    public function __construct(){
        
    }

    
   public function setId($id){
      return $this->id=$id;
   }

   public function getId(){
      return $this->id;
   }

   public function setEmailContato($email_contato){
      return $this->email_contato=$email_contato;
   }

   public function getEmailContato(){
      return $this->email_contato;
   }
    
   public function setTelefoneContato($telefone_contato){
      return $this->telefone_contato=$telefone_contato;
   }

   public function getTelefoneContato(){
      return $this->telefone_contato;
   }
    
}

?>