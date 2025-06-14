<?php 

namespace src\Repository;

use src\Config\Connection;
use PDOException;
use PDO;
use src\Model\Secretaria;

class SecretariaRepository {
    private $pdo;
    
    public function __construct() {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    public function criarLoginSecretaria($secretaria): Secretaria {
        try {
            require_once(__DIR__ . '/../../Config/Connection.php');
            $conexao = new Connection();
            $this->pdo = $conexao->getConnection(); 

            $this->pdo->beginTransaction();

        
            $sql = "INSERT INTO secretaria (nome, email, senha) 
                        VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $secretaria->getNome(),
                $secretaria->getEmail(),
                $secretaria->getSenha(),
            ]);

            $this->pdo->commit(); 

            return $secretaria; 

        } catch (PDOException $e) {
            if ($this->pdo && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function checarLogin($email, $senha) {
        try {
            $stmt = $this->pdo->prepare("SELECT email, senha FROM secretaria WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetch(PDO::FETCH_OBJ);

                if (password_verify($senha, $resultado->senha)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } catch (PDOException $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }
}
?>
