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

                if (!empty($_FILES['thumbnail']['name'])) {
                    $nomeArquivo = $_FILES['thumbnail']['name'];
                    $tipo = $_FILES['thumbnail']['type'];
                    $nomeTemporario = $_FILES['thumbnail']['tmp_name'];
                    $erros = array();

                    // Validação de extensão
                    $arquivosPermitidos = ["png", "jpg", "jpeg"];
                    $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
                    if (!in_array($extensao, $arquivosPermitidos)) {
                        $erros[] = "Arquivo não permitido.<br>";
                    }

                    // Validação de MIME type
                    $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
                    if (!in_array($tipo, $typesPermitidos)) {
                        $erros[] = "Tipo de arquivo não permitido.<br>";
                    }

                    if (!empty($erros)) {
                        foreach ($erros as $erro) {
                            echo $erro;
                        }
                    }else {
                        echo 'continuar upload';
                        $caminho = __DIR__ . '/../../public/images/uploads/'
                    }
                }
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