<?php

namespace src\Controller;

use PDOException;
use src\Config\Connection;
use src\Model\Evento;
use src\Repository\EventoRepository;
use src\Service\EventoService;

class EventoController
{
    public function processarFormulario()
    {
        $repository = new EventoRepository();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['titulo']) &&
                isset($_POST['descricao']) &&
                isset($_POST['capacidade']) &&
                isset($_POST['responsavel']) &&
                isset($_POST['horaEvento']) &&
                isset($_POST['dataEvento']) &&
                isset($_POST['categoriaEvento'])
            ) {
                $thumbnail = null;
                if (!empty($_FILES['thumbnail']['name'])) {
                    $nomeArquivo = $_FILES['thumbnail']['name'];
                    $tipo = $_FILES['thumbnail']['type'];
                    $nomeTemporario = $_FILES['thumbnail']['tmp_name'];
                    $erroTipo = false;
                    $erroMIME = false;

                    // Validação de extensão
                    $arquivosPermitidos = ["png", "jpg", "jpeg"];
                    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                    if (!in_array($extensao, $arquivosPermitidos)) {
                        $erroTipo = true;
                    }

                    // Validação de MIME type
                    $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
                    if (!in_array($tipo, $typesPermitidos)) {
                        $erroMIME = true;
                    }

                    if (!$erroTipo && !$erroMIME) {
                        $caminho = __DIR__ . '/../../public/images/uploads/';
                        
                        if (!file_exists($caminho)) {
                            mkdir($caminho, 0777, true);
                        }

                        // Gerar nome único para o arquivo
                        $novoNome = uniqid() . '.' . $extensao;
                        
                        if (move_uploaded_file($nomeTemporario, $caminho . $novoNome)) {
                            $thumbnail = '/images/uploads/' . $novoNome;
                        }
                    }
                }

                $titulo = trim($_POST['titulo']);
                $descricao = trim($_POST['descricao']);
                $capacidade = trim($_POST['capacidade']);
                $responsavel = trim($_POST['responsavel']);
                $horaEvento = trim($_POST['horaEvento']);
                $dataEvento = trim($_POST['dataEvento']);
                $categoriaEvento = trim($_POST['categoriaEvento']);

                if (
                    empty($titulo) || empty($descricao) ||
                    empty($capacidade) || empty($responsavel) ||
                    empty($horaEvento) || empty($dataEvento) ||
                    empty($categoriaEvento) || $thumbnail === null
                ) {
                    echo "Preencha todos os campos, incluindo a thumbnail";
                } else {
                    try {
                        $evento = new Evento();
                        $evento->setNome($titulo);
                        $evento->setDescricao($descricao);
                        $evento->setCategoriaEvento($categoriaEvento);
                        $evento->setCapacidade($capacidade);
                        $evento->setThumbnail($thumbnail);
                        $evento->setHoraEvento($horaEvento);
                        $evento->setDataEvento($dataEvento);
                      
                        echo 'Dados enviados';
                        return $repository->save($evento);
                    } catch (PDOException $e) {
                    
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }
    }
  
}