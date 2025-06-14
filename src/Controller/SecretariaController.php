<?php

namespace src\Controller;

use PDOException;
use src\Config\Connection;
use src\Model\Secretaria;
use src\Repository\SecretariaRepository;
use src\Service\SecretariaService;

class SecretariaController {

    private $repository;
    public function __construct() {
        $this->repository = new SecretariaRepository();
    }

    public function processarLogin() {

        $repository = new SecretariaRepository();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['email']) &&
                isset($_POST['senha'])
            ) {
                
                $email = trim($_POST['email']);
                $senha = trim($_POST['senha']);

                try {
                    $result = $repository->checarLogin($email, $senha);

                    if ($result) {
                        # echo "<script>window.alert('Bem-Vindo!')</script>";
                        header('Location: /unievent-project/src/View/home.php');
                        exit();
                    } else {
                        # echo "<script>window.alert('Email ou senha inválidos!')</script>";
                        header('Location: /unievent-project/src/View/login.php');
                        exit();
                    }
                    
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        }
    }
   public function processarCadastro() {

        $repository = new SecretariaRepository();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['nome']) &&
                isset($_POST['email']) &&
                isset($_POST['senha'])
            ) {
                $nome = trim($_POST['nome']);
                $email = trim($_POST['email']);
                $senha = trim($_POST['senha']);

                $service = new SecretariaService;

                if ($service->validarEmail($email)) {
                    try {
                        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                        $secretaria = new Secretaria();
                        $secretaria->setNome($nome);
                        $secretaria->setEmail($email);
                        $secretaria->setSenha($senhaHash);
                        
                        $repository->criarLoginSecretaria($secretaria);
                        header('Location: /unievent-project/src/View/home.php');
                        exit();
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } else {
                    echo "<script>window.location.href = '/../UniEvent-Project/src/View/login.php';</script>";
                }
            }
        }  
   }  
}

?>