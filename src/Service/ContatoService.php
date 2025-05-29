<?php

namespace src\Service;

use PDOException;

class ContatoService {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function save($contato,$responsavel_evento) {
        try {
            $this->conexao->beginTransaction();

            $sql = "INSERT INTO contato (email_contato, telefone_contato) VALUES (?, ?)";
            $stmt = $this->conexao->prepare($sql);

            $stmt->execute([
                $contato->getEmailContato(),
                $contato->getTelefoneContato()
            ]);


            $id_contato = $this->conexao->lastInsertId();


            $sql = "INSERT INTO responsavelevento(nome,id_contato_fk) VALUES (?,?)";
            $stmt=$this->conexao->prepare($sql);
            $responsavel_evento->setIdContatoFk($id_contato);
            $stmt->execute([$responsavel_evento->getNome(),$responsavel_evento->getIdContatoFk()]);
             $this->conexao->commit();
             return  true;

        } catch (PDOException $e) {
            if ($this->conexao->inTransaction()) {
                $this->conexao->rollBack();
            }
           
            throw $e;
        }
    }
}
?>