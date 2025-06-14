<?php

namespace src\Service;
class SecretariaService{

    public static function validarEmail($email):bool{

        if (preg_match('/^[a-zA-Z0-9._%+-]+@fatec\.sp\.gov\.br$/', $email)) {
            echo "<script>window.alert('Responsável Criado com Sucesso!')</script>";
            return true;
        } else {
            echo "<script>window.alert('Email deve ser institucional!')</script>";
            return false;
        }
}
}
?>