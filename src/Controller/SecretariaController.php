<?php
namespace src\Controller;

use PDO;
use PDOException;
use src\Config\Connection;
use src\Model\Secretaria;
use src\Repository\SecretariaRepository;
use src\Service\SecretariaService;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class SecretariaController {
    private $repository;
    
    public function __construct() {
        $this->repository = new SecretariaRepository();
    }

    public function processarLogin() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['email'], $_POST['senha'])) {
            $this->redirecionarComMensagem('Dados incompletos!', '/unievent-project/src/View/login.php');
            return;
        }

        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        try {
            $usuario = $this->repository->checarLogin($email, $senha);
            
            if ($usuario !== false) {
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_email'] = $usuario->email;
                $_SESSION['usuario_nome'] = $usuario->nome ?? '';
                header('Location: /unievent-project/src/View/home.php');
                exit();
            } else {
                $this->redirecionarComMensagem('Credenciais inválidas!', '/unievent-project/src/View/login.php');
            }
            
        } catch (PDOException $e) {
            $this->redirecionarComMensagem('Erro no sistema. Tente novamente.', '/unievent-project/src/View/login.php');
        }
    }

    public function processarCadastro() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
            $this->redirecionarComMensagem('Dados incompletos!', '/unievent-project/src/View/login.php');
            return;
        }

        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        $connection = new Connection();
        $pdo = $connection->getConnection();

        if (!SecretariaService::validarEmail($email, $pdo)) {
            $this->redirecionarComMensagem('Email inválido ou já cadastrado!', '/unievent-project/src/View/login.php');
            return;
        }

        try {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $secretaria = new Secretaria();
            $secretaria->setNome($nome);
            $secretaria->setEmail($email);
            $secretaria->setSenha($senhaHash);
            
            $resultado = $this->repository->criarLoginSecretaria($secretaria);
            
            if (!$resultado || !isset($resultado['chave'])) {
                throw new \Exception('Falha ao criar usuário');
            }

            $this->enviarEmailConfirmacao($email, $nome, $resultado['chave']);
            
            echo "<script>
                alert('Usuário cadastrado com sucesso. Necessário ativar a conta pelo email de confirmação.');
                window.location.href = '/unievent-project/src/View/login.php';
            </script>";
            
        } catch (PDOException $e) {
            $this->redirecionarComMensagem('Erro no banco de dados: ' . $e->getMessage(), '/unievent-project/src/View/login.php');
        } catch (\Exception $e) {
            $this->redirecionarComMensagem($e->getMessage(), '/unievent-project/src/View/login.php');
        }
    }

    private function enviarEmailConfirmacao($email, $nome, $chave) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ddc28ad069ebb0';
            $mail->Password   = '9fb7e6a6c24d0e';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 2525;
            
            $mail->setFrom('unievent@administracao.com', 'Administração');
            $mail->addAddress($email, $nome);
            
            $mail->isHTML(true);
            $mail->Subject = 'Confirme o e-mail';
            $mail->Body    = $this->getEmailBody($nome, $chave);
            $mail->AltBody = $this->getEmailTextBody($nome, $chave);
            
            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Erro ao enviar email: {$mail->ErrorInfo}");
        }
    }

    private function getEmailBody($nome, $chave) {
        return "Prezado(a) " . $nome . ".<br><br>Agradecemos a sua solicitação de cadastro em nosso sistema!<br><br>Para que possamos liberar o seu cadastro
        em nosso sistema, solicitamos a confirmação do e-mail por meio deste link abaixo: <br><br><a href='http://localhost/unievent-project/src/Service/ConfirmarEmail.php?chave=$chave'>Clique aqui</a><br><br>
        Esta mensagem foi enviado a você pela empresa UniEvent.<br>Você está recebendo porque está cadastrado no banco de dados da empresa UniEvent. 
        Nenhum e-mail enviado pela empresa UniEvent tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>";
    }

    private function getEmailTextBody($nome, $chave) {
        return "Prezado(a) " . $nome . ".\n\nAgradecemos a sua solicitação de cadastro em nosso sistema!\n\nPara que possamos liberar o seu cadastro
        em nosso sistema, solicitamos a confirmação do e-mail por meio deste link abaixo: \n\nhttp://localhost/unievent-project/src/Service/ConfirmarEmail.php?chave=$chave\n\n
        Esta mensagem foi enviado a você pela empresa UniEvent.\nVocê está recebendo porque está cadastrado no banco de dados da empresa UniEvent. 
        Nenhum e-mail enviado pela empresa UniEvent tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";
    }

    private function redirecionarComMensagem($mensagem, $url) {
        $_SESSION['msg'] = "<div class='alert-message alert-error'>$mensagem</div>";
        header("Location: $url");
        exit();
    }
}
?>