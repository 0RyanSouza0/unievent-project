<?php

namespace src\Service;
class ContatoService{

    public static function validarEmail($email):bool{

        if (preg_match('/^[a-zA-Z0-9._%+-]+@fatec\.sp\.gov\.br$/', $email)) {
            echo "<script>window.alert('Responsável Criado com Sucesso!')</script>";
            echo "<script>window.location.href = '/../UniEvent-Project/src/View/home.html';</script>";
            return true;
        } else {
            echo "<script>window.alert('Email Inválido!')</script>";
            echo "<script>window.location.href = '/../UniEvent-Project/src/View/criarResponsavel.php';</script>";
            return false;
        }
}
}
?>