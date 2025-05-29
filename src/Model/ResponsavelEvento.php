<?php

namespace src\Model;
use src\Model\Contato;
class ResponsavelEvento{

   private $id;
   private $nome;
   private $id_contato_fk;


   public function __construct()
   {
   }

   public function setId($id){
      return $this->id=$id;
   }

   public function getId(){
      return $this->id;
   }

   public function setNome($nome){
      return $this->nome=$nome;
   }

   public function getNome(){
      return $this->nome;
   }

   public function setIdContatoFk($id_contato_fk){
      return $this->id_contato_fk=$id_contato_fk;
   }

   public function getIdContatoFk(){
      return $this->id_contato_fk;
   }
   
}
?>