<?php

namespace src\Repository;

use PDOException;

class ContatoRepository {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    

    public function save($contato,$responsavel_evento) {
        try {
            $this->conexao->beginTransaction();

            $sql = "INSERT INTO contato (email_contato, telefone_contato) VALUES (?, ?)";
            $stmt = $this->conexao->prepare($sql);

            $stmt->exec([
                $contato->getEmailContato(),
                $contato->getTelefoneContato()
            ]);


            $id_contato = $this->conexao->lastInsertId();


            $sql = "INSERT INTO responsavelevento(nome,id_contato_fk) VALUES (?,?)";
            $stmt=$this->conexao->prepare($sql);
            $responsavel_evento->setIdContatoFk($id_contato);
            $stmt->exec([$responsavel_evento->getNome(),$responsavel_evento->getIdContatoFk()]);
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