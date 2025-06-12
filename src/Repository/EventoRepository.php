<?php

namespace src\Repository;

use src\Config\Connection;
use PDOException;
use PDO;
use src\Model\Evento;

class EventoRepository {
   
    private $pdo;
    
    public function __construct() {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    public function excluir($id) {
        try {
            $this->pdo->beginTransaction();

            // Usando prepared statement para evitar SQL injection
            $query = "DELETE FROM evento WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->pdo->commit();
            
            return $stmt->rowCount(); // Retorna quantas linhas foram afetadas
        } catch (PDOException $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function listarTodos(): array {
        $stmt = $this->pdo->query("SELECT * FROM evento");
    
        // Configuração correta do fetch mode
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Evento::class);
        $eventos = $stmt->fetchAll();
        
        return $eventos;
    }

    public function buscarPorId($id): ?Evento {
        try {
            $query = "SELECT * FROM evento WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Evento::class);
            $evento = $stmt->fetch();
            
            return $evento ?: null;
            
        } catch (PDOException $e) {
            error_log("Erro ao buscar evento: " . $e->getMessage());
            throw $e;
        }
    }


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
    public function atualizar(Evento $evento) : bool {
        try {
            require_once(__DIR__ . '/../../Config/Connection.php');
            $conexao = new Connection();
            $this->pdo = $conexao->getConnection();
            $this->pdo->beginTransaction(); 

            if(!empty($evento->getThumbnail())){
            $sql = "UPDATE evento SET nome = :nome, descricao = :descricao, categoria_evento = :categoria_evento, hora_evento = :hora_evento, data_evento = :data_evento,
                        capacidade = :capacidade, thumbnail = :thumbnail WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $evento->getNome(),
                ':descricao' => $evento->getDescricao(),
                ':categoria_evento' => $evento->getCategoriaEvento(),
                ':hora_evento' => $evento->getHoraEvento(),
                ':data_evento' => $evento->getDataEvento(),
                ':capacidade' => $evento->getCapacidade(),
                ':thumbnail' => $evento->getThumbnail(),
                ':id' => $evento->getId()
            ]);

            $this->pdo->commit(); 

            return $stmt->rowCount() > 0;
        }else{
                        $sql = "UPDATE evento SET nome = :nome, descricao = :descricao, categoria_evento = :categoria_evento, hora_evento = :hora_evento, data_evento = :data_evento,
                        capacidade = :capacidade WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $evento->getNome(),
                ':descricao' => $evento->getDescricao(),
                ':categoria_evento' => $evento->getCategoriaEvento(),
                ':hora_evento' => $evento->getHoraEvento(),
                ':data_evento' => $evento->getDataEvento(),
                ':capacidade' => $evento->getCapacidade(),
                ':id' => $evento->getId()
            ]);

            $this->pdo->commit(); 

            return $stmt->rowCount() > 0;
        }
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
    public static function getAll(){
        try{    
            $conexao = new Connection();
            $pdo = $conexao->getConnection(); 
            $consulta = $pdo->query("SELECT nome FROM evento;");


            while ($linha = $consulta->fetchAll(PDO::FETCH_ASSOC)) {
                echo "Nome: {$linha['nome']} <br />";
        }
        }catch(PDOException $e){
            throw $e;
        }
    }
    
}
?>