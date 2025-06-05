<?php

namespace src\Repository;

use src\Config\Connection;
use PDOException;
use src\Model\Evento;

class EventoRepository {
   
    private $pdo;
    public function save($evento): Evento {
    try {
        require_once(__DIR__ . '/../../Config/Connection.php');
        $conexao = new Connection();
        $this->pdo = $conexao->getConnection(); 

        $this->pdo->beginTransaction();

    
        $sql = "INSERT INTO evento (nome, descricao, categoria_evento, hora_evento, data_evento, capacidade, thumbnail) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $evento->getNome(),
            $evento->getDescricao(),
            $evento->getCategoriaEvento(),
            $evento->getHoraEvento(),
            $evento->getDataEvento(),
            $evento->getCapacidade(),
            $evento->getThumbnail()
        ]);

        $this->pdo->commit(); 

        return $evento; 

    } catch (PDOException $e) {
        if ($this->pdo && $this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
        throw $e;
    }
}

}
?>