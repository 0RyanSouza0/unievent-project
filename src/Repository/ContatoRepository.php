<?php

namespace src\Repository;

use src\Config\Connection;
use PDOException;
use src\Model\ResponsavelEvento;

class ContatoRepository {
   
    private $pdo;
    public function save($contato, $responsavel_evento): ResponsavelEvento {
        try {
            require_once(__DIR__ . '/../../Config/Connection.php');
            $conexao = new Connection();
            $this->pdo = $conexao->getConnection(); 

            $this->pdo->beginTransaction();

        
            $sql = "INSERT INTO contato (email_contato, telefone_contato) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $contato->getEmailContato(),
                $contato->getTelefoneContato()
            ]);

            $id_contato = $this->pdo->lastInsertId();

            
            $sql = "INSERT INTO responsavelevento(nome, id_contato_fk) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $responsavel_evento->setIdContatoFk($id_contato);
            $stmt->execute([
                $responsavel_evento->getNome(),
                $responsavel_evento->getIdContatoFk()
            ]);

            $this->pdo->commit(); 

            return $responsavel_evento; 
            

        } catch (PDOException $e) {
            if ($this->pdo && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }


    // $responsavelRepository->updateResponsavel('id', 22, ['name'=>'alexa'])
    public function updateResponsavel(string|int $id, string $nome, int $telefone_contato) {
        try {
            require_once(__DIR__ . '/../../Config/Connection.php');
            $conexao = new Connection();
            $this->pdo = $conexao->getConnection(); 
            $this->pdo->beginTransaction();

            $sql_nome = "update responsavelevento set nome = ? where id = ?";
            $stmt = $this->pdo->prepare($sql_nome);
            $stmt->execute([$nome, $id]);
            
            $sql_telefone = "update contato set telefone_contato = ? where id = ?";
            $stmt = $this->pdo->prepare($sql_telefone);
            $stmt->execute([$telefone_contato, $id]);

            return $this->pdo->commit();

            echo 'dados enviados';
        } catch (PDOException $e) {
            if ($this->pdo && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function listarResponsaveis(): array {
        $stmt = $this->pdo->query("SELECT nome FROM responsavelevento ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>