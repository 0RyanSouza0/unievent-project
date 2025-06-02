<?php

namespace src\Controller;

use PDOException;
use src\Model\Contato;
use src\Config\Connection;
use src\Model\ResponsavelEvento;
use src\Repository\ContatoRepository;
use src\Service\ContatoService;
class ResponsavelEventoController{

    public function processarFormulario(){
       
        $repository = new ContatoRepository();

        if($_SERVER['REQUEST_METHOD']== 'POST'){

            if(
               isset($_POST['email_contato'])&&
               isset($_POST['telefone_contato'])&&
               isset($_POST['nome'])
               
            ){
                $email_contato=trim($_POST['email_contato']);
                $telefone_contato=trim($_POST['telefone_contato']);
                $nome=trim($_POST['nome']);
                if(empty($email_contato)|| empty($telefone_contato)|| empty($nome)){
                    echo "preencha todos os campos";
                }
                else{
                    try{
                        $contato = new Contato();
                        $contato->setEmailContato($email_contato);
                        $contato->setTelefoneContato($telefone_contato);
                        $responsavel = new ResponsavelEvento();
                        $responsavel->setNome($nome);
                        ResponsavelEventoController::chamar();
                        return  $repository->save($contato,$responsavel);
                    }catch(PDOException $e){
                        echo "Error".$e;
                    }
                }
            }

        }


    }
    public static function chamar(){
        echo "salve";
    }
}

?>