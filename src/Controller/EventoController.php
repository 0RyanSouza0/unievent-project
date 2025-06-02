<?php

namespace src\Controller;

use PDOException;
use src\Config\Connection;
use src\Model\Evento;
use src\Repository\EventoRepository;
use src\Service\EventoService;
class EventoController{

    public function processarFormulario(){
       
        $repository = new EventoRepository();
        
        if($_SERVER['REQUEST_METHOD']== 'POST'){

            if(
               isset($_POST['titulo'])&&
               isset($_POST['descricao'])&&
               isset($_POST['capacidade'])&&
               isset($_POST['responsavel'])&&
               isset($_POST['horaEvento'])&&
               isset($_POST['dataEvento'])&&
               isset($_POST['categoriaEvento'])
               
            ){
                $titulo=trim($_POST['titulo']);
                $descricao=trim($_POST['descricao']);
                $capacidade=trim($_POST['capacidade']);
                $responsavel=trim($_POST['responsavel']);
                $thumbnail = trim($_POST['thumbnail']);
                $horaEvento=trim($_POST['horaEvento']);
                $dataEvento=trim($_POST['dataEvento']);
                $categoriaEvento=trim($_POST['categoriaEvento']);

                if
                (
                    empty($titulo)|| empty($descricao)|| 
                    empty($capacidade)|| empty($responsavel)|| 
                    empty($horaEvento)|| 
                    empty($dataEvento)|| empty($categoriaEvento)
                ){
                    echo $titulo;
                    echo $descricao;
                    echo $capacidade;
                    echo $responsavel;
                    echo $thumbnail;
                    echo $horaEvento;
                    echo $dataEvento;
                    echo $categoriaEvento;
                    echo "preencha todos os campos";
                }
                else{
                    try{
                        $evento = new Evento();
                        $evento->setNome($titulo);
                        $evento->setDescricao($descricao);
                        $evento->setCategoriaEvento($categoriaEvento);
                        $evento->setCapacidade($capacidade);
                        $evento->setThumbnail($thumbnail);
                        $evento->setHoraEvento($horaEvento);
                        $evento->setDataEvento($dataEvento);
                        EventoController::print();
                        return  $repository->save($evento);
                    }catch(PDOException $e){
                        echo "Error".$e;
                    }
                }
            }

        }


    }
    public static function print() {
        echo 'dados enviados';
    }
}

?>