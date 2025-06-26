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
            // Verifica se existe conta com este email
            $stmt = $this->pdo->prepare("SELECT id, email, senha, nome, situacao, tentativas_login FROM secretaria WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return ['status' => 'credenciais_invalidas'];
            }

            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            // Verifica status da conta
            if ($usuario->situacao == 'aguardando confirmacao') {
                return ['status' => 'email_nao_confirmado'];
            } 
            
            if ($usuario->situacao == 'inativo') {
                return ['status' => 'conta_inativa'];
            }

            // Verifica a senha
            if (password_verify($senha, $usuario->senha)) {
                // Reseta tentativas em caso de sucesso
                $this->resetarTentativas($usuario->id);
                return [
                    'status' => 'sucesso',
                    'usuario' => $usuario
                ];
            } else {
                // Incrementa tentativas falhas
                $tentativas = $this->incrementarTentativa($usuario->id);
                
                if ($tentativas >= 5) {
                    return [
                        'status' => 'conta_bloqueada',
                        'usuario' => $usuario 
                    ];
                }
                
                return [
                    'status' => 'credenciais_invalidas',
                    'tentativas_restantes' => 5 - $tentativas
                ];
            }

        } catch (PDOException $e) {
            throw $e;
        }
    }

    private function incrementarTentativa($usuarioId) {
        $stmt = $this->pdo->prepare("UPDATE secretaria SET tentativas_login = tentativas_login + 1 WHERE id = :id");
        $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Retorna o novo número de tentativas
        $stmt = $this->pdo->prepare("SELECT tentativas_login FROM secretaria WHERE id = :id");
        $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    private function resetarTentativas($usuarioId) {
        $stmt = $this->pdo->prepare("UPDATE secretaria SET tentativas_login = 0 WHERE id = :id");
        $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>