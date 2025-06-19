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

    public function criarLoginSecretaria($secretaria): array {
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO secretaria (nome, email, senha, chave, situacao) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            
            $chave = bin2hex(random_bytes(16));
            
            $stmt->execute([
                $secretaria->getNome(),
                $secretaria->getEmail(),
                $secretaria->getSenha(),
                $chave,
                "aguardando confirmacao"
            ]);

            $this->pdo->commit(); 

            return [
                'secretaria' => $secretaria,
                'chave' => $chave
            ];

        } catch (PDOException $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function checarLogin($email, $senha) {
        try {
            $checkStmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM secretaria WHERE email = :email");
            $checkStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $checkStmt->execute();
            $countResult = $checkStmt->fetch(PDO::FETCH_OBJ);
            
            if ($countResult->total > 1) {
                $_SESSION['msg'] = "<div class='alert-message alert-error'>Erro: Múltiplas contas encontradas com este e-mail. Contate a administração</div>";
                header("Location: /unievent-project/src/View/login.php");
                exit();
            }

            $stmt = $this->pdo->prepare("SELECT id, email, senha, situacao FROM secretaria WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetch(PDO::FETCH_OBJ);

                if ($resultado->situacao == 'aguardando confirmacao') {
                    $_SESSION['msg'] = "<div class='alert-message alert-error'>Erro: Necessário confirmar o e-mail!</div>";
                    header("Location: /unievent-project/src/View/login.php");
                    exit();
                } 
                
                if ($resultado->situacao == 'inativo') {
                    $_SESSION['msg'] = "<div class='alert-message alert-error'>Erro: Perfil não encontrado!</div>";
                    header("Location: /unievent-project/src/View/login.php");
                    exit();
                }

                if (password_verify($senha, $resultado->senha)) {
                    return $resultado;
                }
            }

            return false;

        } catch (PDOException $e) {
            throw $e;
        }
    }
}

?>